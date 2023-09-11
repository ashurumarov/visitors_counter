### Запуск проекта

```shell
./run.sh run-project
```

##### Записать посетителя для страны:
`POST http://localhost/api/countries/visitors/update`

POST body:
```json
{
  "countryCode": "it" // ru, hr, us, etc...
}
```

##### Получить посетителей всех стран:
`GET http://localhost/api/countries/visitors/get`

Бенч:
```
Running 30s test @ http://localhost/api/countries/visitors/get
  12 threads and 40 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency   155.36ms   62.29ms 395.69ms   67.40%
    Req/Sec     9.54      5.63    39.00     71.97%
  2761 requests in 30.09s, 1.02MB read
  Socket errors: connect 0, read 2761, write 0, timeout 0
Requests/sec:     91.75
Transfer/sec:     34.58KB

----------------------------------------------------------------------

Running 30s test @ http://localhost/api/countries/visitors/get
  12 threads and 400 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency     1.22s   134.20ms   1.69s    79.79%
    Req/Sec     2.24      3.13    10.00     88.00%
  94 requests in 30.10s, 41.31KB read
  Socket errors: connect 157, read 1673, write 0, timeout 0
Requests/sec:      3.12
Transfer/sec:      1.37KB

----------------------------------------------------------------------

Running 1s test @ http://localhost/api/countries/visitors/get
  1 threads and 400 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency    69.04ms   15.69ms  90.16ms   60.00%
    Req/Sec    47.00      0.00    47.00    100.00%
  5 requests in 1.13s, 1.88KB read
  Socket errors: connect 150, read 5, write 0, timeout 0
Requests/sec:      4.42
Transfer/sec:      1.67KB

----------------------------------------------------------------------

Running 1s test @ http://localhost/api/countries/visitors/get
  100 threads and 400 connections
  Thread Stats   Avg      Stdev     Max   +/- Stdev
    Latency   468.96ms   66.09ms 538.47ms   83.33%
    Req/Sec     5.26      6.59    29.00     88.57%
  54 requests in 1.10s, 20.36KB read
  Socket errors: connect 249, read 54, write 0, timeout 0
Requests/sec:     49.02
Transfer/sec:     18.48KB
```
