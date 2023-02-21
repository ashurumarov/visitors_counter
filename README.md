### Запуск проекта

```shell
./run.sh run-project
```

##### Записать посетителя для страны:
`POST http://localhost/api/countries/update/visitors`

POST body:
```json
{
  "countryCode": "it" // ru, hr, us, etc...
}
```

##### Получить посетителей всех стран:
`GET http://localhost/api/countries/get/visitors`
