# Mocktainer #
![alt text](https://raw.githubusercontent.com/yesinteractive/mocktainer/master/public/banner-mocktainer.png "Mocktainer mocking microservice")

[![Docker Pulls](https://img.shields.io/docker/pulls/yesinteractive/mocktainer?style=for-the-badge)](https://hub.docker.com/r/yesinteractive/mocktainer) 
[![GitHub stars](https://img.shields.io/github/stars/yesinteractive/mocktainer?style=for-the-badge)](https://github.com/yesinteractive/dad-jokes_microservice) 
[![GitHub release](https://img.shields.io/github/release/yesinteractive/mocktainer?style=for-the-badge)](https://github.com/yesinteractive/dad-jokes_microservice) 
![MIT](https://img.shields.io/badge/license-MIT-green?style=for-the-badge)



Mocktainer is a micro service that mocks micro service API's
 with fake data accross multiple endpoints representing various
 verticals and functions.

## Hosted Service / Demo ##

Access [http://notno.io/mocktainer](http://notno.io/mocktainer) to try the free hosted service.

## Usage ##

##### Endpoints:
 * `/` Root returns help and instructions in HTML format
 * `/accounts` Returns mock bank accounts in JSON
 * `/customers` Returns mock customers in JSON
 * `/employees` Returns mock employees in JSON
 * `/inventory` Returns mock product inventory in JSON
 * `/orders` Returns mock orders in JSON
 * `/portfolio` Returns mock investment portfolio in JSON
 * `/prescriptions` Returns mock drug prescriptions list in JSON
 * `/trades` Returns mock trades in JSON
 
 **Echo URI** : Simply add `/echo` to the end of any endpoint above to echo back
 the original request with payload and request headers. Helpful for troublshooting.
 
 **Adding New Endpoints** : See instructions below.

**Methods Supported** : `GET` `PUT` `POST` `DELETE` `PATCH`

**Parameters** : `?n=<number>` to specify number of records to return. Default is 10. Max is 250.

**Successful Response** : `200 OK`



```json
{
  "Results":  {
                  ...
              }
  "Request":  {
                  ...
              },
}
```

## Installation ##

### Deployment Examples ###

See usage examples for Kubernetes, Kong for Kubernetes Ingress Controller, and docker-compose in the [examples directory folder.](https://github.com/yesinteractive/mocktainer/blob/master/examples)


### BEHIND REVERSE PROXY CONFIGURATION ###

If behind an API gateway or reverse proxy, you may wish to have only the URI of the original request
echoed back and not the URI of the upstream proxy target. To do this you may add the docker environment
variable `APP_BEHIND_PROXY=TRUE` to your configuration or set the global `behind_proxy`configuration
to true in the `config/fsl_config.php` file.


### With Docker ###

Docker image is Alpine 3.11 based running PHP 7.3 on Apache. The container exposes both ports 80 an 443 with a self signed certificated. If you wish to alter the container configuration, feel free to use the Dockerfile in this repo (https://github.com/yesinteractive/mocktainer/blob/master/Dockerfile). Otherwise, you can pull the latest image from DockerHub with the following command:
```
docker pull yesinteractive/mocktainer
```
Typical basic usage (below example exposes mocktainer on host ports 8100 and 8143):

```
$ docker run -d \
  -p 8100:80 \
  -p 8143:443 \
  yesinteractive/mocktainer
```

Typical usage in Dockerfile:

```
FROM yesinteractive/mocktainer
RUN echo <your commands here>
```

## Adding New Endpoints ##

Adding a new endpoint is as simple as adding a new CSV file in the [endpoints](https://github.com/yesinteractive/mocktainer/tree/master/endpoints) directory.
The name of the csv will be the dynamic endpoint. The first row must be column header names and 
there is no limit to the amount of columns. See examples in the controllers directory.

## Contributing ##

If you have an endpoint to share, please add your submission via a [pull request](https://github.com/yesinteractive/mocktainer/pulls).
