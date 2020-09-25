## Каналы

[Главная](main.md) 

### Получение каналов пользователя

Для получения каналов пользователя необходимо отправить **`GET`** запрос на **`/v1/channel`**

Пример ответ:<br>
```
{
    "data":[
        {
            "channel_id": 6,
            "title": "Mr.",
            "slug": "mr",
            "status": "active",
            "owner_id": 2,
            "private": 0,
            "type": "chat",
            "user_count": 2,
            "avatar":{
                "origin": "http://files.newchannels.loc/var/www/newchannels.loc/storage/app/public/img/channel/b/b6/b6ba4c2140f71b3430a7aaf44a4bd2e1.jpg",
                "average": "http://files.newchannels.loc/var/www/newchannels.loc/storage/app/public/img/channel/b/b6/b6ba4c2140f71b3430a7aaf44a4bd2e1_400.jpg",
                "small": "http://files.newchannels.loc/var/www/newchannels.loc/storage/app/public/img/channel/b/b6/b6ba4c2140f71b3430a7aaf44a4bd2e1_150.jpg"
            }
        },
        {
            "channel_id": 106,
            "title": "Не работает доменное имя",
            "slug": "eee",
            "status": "active",
            "owner_id": 2,
            "private": 0,
            "type": "wall",
            "user_count": 2,
            "avatar":{
                "origin": null,
                "average": null,
                "small": null
            }
        }
    ]
}
```

### Добавление канала

Для того, чтобы добавить канал, необходимо отправить 
**`POST`** запрос на **`/v1/channel`**

Параметры:<br>
**title*** - название канала.<br>
**slug*** - url канала.<br>
**status*** - принимает 2-а значения 'active' и 'disable'.<br>
**owner_id*** - идентификатор создателя канала.<br>
**user_ids*** - массив пользователей канала.<br>
**type*** - тип канала, принимает такие значения: 
'chat', 'wall' и 'dialog'<br>
**private*** - приватность канала, принимает 0 или 1.<br>
**avatar** - автарка канала, 
принимает идентификатор заранее загруженной аватарки.

Пример ответ:<br>

```
{
    "data":{
        "channel_id": 1,
        "title": "Ms.",
        "slug": "ms",
        "status": "disable",
        "owner_id": 2,
        "private": 1,
        "type": "chat",
        "user_count": 2,
        "avatar":{
            "origin": null,
            "average": null,
            "small": null
        }
    }
}
```

### Редактирование канала

Для того, чтобы редактировать канал, необходимо отправить 
**`PUT`** запрос на **`/v1/channel/{channel_id}`**

Параметры:<br>
**title*** - название канала.<br>
**slug*** - url канала.<br>
**status*** - принимает 2-а значения 'active' и 'disable'.<br>
**owner_id*** - идентификатор создателя канала.<br>
**user_ids*** - массив пользователей канала.<br>
**type*** - тип канала, принимает такие значения: 
'chat', 'wall' и 'dialog'<br>
**private*** - приватность канала, принимает 0 или 1.<br>
**avatar** - автарка канала, 
принимает идентификатор заранее загруженной аватарки.

### Получение канала по channel_id или slug

Для того, чтобы получить канал, необходимо отправить 
**`GET`** запрос на **`/v1/channel/{channel_id|slug}`**

Пример ответ:<br>

```
{
    "data":{
        "channel_id": 1,
        "title": "Ms.",
        "slug": "ms",
        "status": "disable",
        "owner_id": 2,
        "private": 1,
        "type": "chat",
        "user_count": 2,
        "avatar":{
            "origin": null,
            "average": null,
            "small": null
        }
    }
}
```

### Добавление пользователя в канал

Для добавления пользователя необходимо отправить
**`POST`** запрос на **`/v1/channel/add-user`**

Параметры:<br>
**user_id*** - идентификатор пользователя.<br>
**channel_id*** - идентификатор канала.<br>

### Удалить пользователя из канала

Для добавления пользователя необходимо отправить
**`DELETE`** запрос на **`/v1/channel/delete-user?user_id={user_id}&channel_id={channel_id}`**

Параметры:<br>
**user_id*** - идентификатор пользователя.<br>
**channel_id*** - идентификатор канала.<br>

### Получение пользователей канала

Для получения пользователей необходимо отправить
**`GET`** запрос на **`/v1/channel/{channel_id}/users`**

### Получение сообщений канала

Для получения пользователей необходимо отправить
**`GET`** запрос на **`/v1/channel/{channel_id}/messages`**

### Удаление канала

Для того, чтобы удалить канал, необходимо отправить 
**`DELETE`** запрос на **`/v1/channel/{channel_id}`**

### Получение списка каналов в группах и каналов без групп для левого меню

Для получения списка каналов в группах и каналов без групп необходимо отправить
**`GET`** запрос на **`/v1/channel/service/left-side-bar`**

Пример ответ:<br>

```
{
    "data": [
        {
            "id": 2,
            "title": "Prof.",
            "slug": "prof",
            "owner_id": 0,
            "type": "group",
            "count": 2,
            "avatar": null,
            "channels": [
                {
                    "id": 2,
                    "title": "Miss",
                    "slug": "miss",
                    "owner_id": 0,
                    "type": "channel",
                    "count": 0,
                    "avatar": null
                },
                {
                    "id": 3,
                    "title": "Mr.",
                    "slug": "mr",
                    "owner_id": 0,
                    "type": "channel",
                    "count": 0,
                    "avatar": null
                }
            ]
        },
        {
            "id": 81,
            "title": "Mrs.",
            "slug": "mrs",
            "owner_id": 1,
            "type": "channel",
            "count": 0,
            "avatar": null
        },
        {
            "id": 80,
            "title": "Dr.",
            "slug": "dr",
            "owner_id": 1,
            "type": "channel",
            "count": 0,
            "avatar": null
        }
    ]
}
```