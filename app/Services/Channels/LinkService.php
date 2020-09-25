<?php
namespace App\Services\Channels;

use App\Dto\Link;
use DiDom\Document;
use Illuminate\Database\Eloquent\Collection;

class LinkService
{
    private const URL_REGEX = '/\b(http:\/\/www\.|https:\/\/www\.|http:\/\/|https:\/\/)?[^,\s()<>]+(?:\([\w\d]+\)|([^,[:punct:]\s]|\/))/i';

    private const USER_AGENT = 'Mozilla/5.0 (Windows NT 6.1; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/75.0.3770.142 Safari/537.36';

    private const CURL_TIMEOUT = 4000;

    private const CONNECT_TIMEOUT = 30;

    private $ch;

    /**
     * LinkService constructor.
     */
    public function __construct()
    {
        $this->ch = curl_init();

        curl_setopt($this->ch, CURLOPT_ENCODING, '');
        curl_setopt($this->ch, CURLOPT_HEADER, 0);
        curl_setopt($this->ch, CURLOPT_USERAGENT, self::USER_AGENT);
        curl_setopt($this->ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($this->ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($this->ch, CURLOPT_TIMEOUT, self::CURL_TIMEOUT);
        curl_setopt($this->ch, CURLOPT_CONNECTTIMEOUT, self::CONNECT_TIMEOUT);
        curl_setopt($this->ch, CURLOPT_RETURNTRANSFER, true);
    }

    /**
     * Закрыть курл
     */
    public function __destruct()
    {
        curl_close($this->ch);
    }

    /**
     * Валидация на наличие ссылок в строке
     *
     * @param string $text
     * @return mixed
     * @throws \Exception
     */
    public static function validate(string $text)
    {
        if(!preg_match_all(self::URL_REGEX, $text, $matches)){
            throw new \Exception('invalid url');
        }

        return $matches;
    }

    /**
     * Валидация на правильную ссылку
     *
     * @param string $url
     * @throws \Exception
     */
    public static function validateSingle(string $url)
    {
        if(!filter_var($url, FILTER_VALIDATE_URL)){
            throw new \Exception('invalid url');
        }
    }

    /**
     * Парсинг ссылок в тексте
     *
     * @param string $text
     * @return array|Collection
     * @throws \Exception
     */
    public function parse(string $text)
    {
        $matches = self::validate($text);

        $links = new Collection();

        foreach ($matches[0] as $url) {
            if($link = $this->grabMeta($url)){
                $links[] = $link;
            }
        }

        return $links;
    }

    /**
     * Извлечь мета данные из html документа
     *
     * @param string $url
     * @return Link
     * @throws \Exception
     */
    public function grabMeta(string $url)
    {
        if (!preg_match("~^(?:f|ht)tps?://~i", $url)) {
            $url = "http://" . $url;
        }

        self::validateSingle($url);

        $html = $this->html($url);

        if(!$html){
            return null;
        }

        $dom = new Document($html);

        $base = parse_url($url, PHP_URL_HOST);

        $description_el = $dom->first('meta[name=description]');
        $description = $description_el? $description_el->attr('content') : '';

        $title_el = $dom->first('title');
        $title = $title_el ? $title_el->text() : '';

        $icon_selectors = ['meta[property="og:image"]','link[rel="apple-touch-icon"]', 'link[rel="icon"][type="image/png"]', 'link[rel$="icon"][type="image/png"]'];
        $icon_attr      = ['content', 'src', 'href', 'href', 'href'];
        $icon = '';

        foreach ($icon_selectors as $i => $selector){
            if($dom->has($selector)){
                $icon = $dom->first($selector)->attr($icon_attr[$i]);
                break;
            }
        }

        return Link::fromArray(compact('url', 'title', 'description', 'icon', 'base'));
    }

    /**
     * Получить HTML страницу
     *
     * @param string $url
     * @return string
     */
    private function html(string $url) : string
    {
        curl_setopt($this->ch, CURLOPT_URL, $url);

        return curl_exec($this->ch);
    }
}
