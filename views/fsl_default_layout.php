<!doctype html>
<html class="no-js" lang="en">
    <head>
        <meta charset="utf-8"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
      <meta name="Keywords" content="rest api testing, api, rest api, csv to json, json, mocking, mock api, api gateway, api testing, kubernetes, docker, container, k8s, testing, application testing, devops, ci/cd, devops tools">
        <title>Mocktainer.io: Mock Restful API Responses to test your API Gateway, service mesh, kubernetes cluster and more</title>
<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/foundation/5.5.2/css/foundation.min.css">
      
    </head>
    <body>
        <div ng-bind-html="trustedHtml" class="ng-binding" style="padding:20px;">
            <h2>Mocktainer.io</h2>
            <p><img src="https://raw.githubusercontent.com/yesinteractive/mocktainer/master/public/banner-mocktainer.png" alt="alt text" title="Mocktainer mocking microservice"></p>
            <p><a href="https://hub.docker.com/r/yesinteractive/mocktainer">
                    <img src="https://img.shields.io/docker/pulls/yesinteractive/mocktainer?style=for-the-badge" alt="Docker Pulls">
                </a> <a href="https://github.com/yesinteractive/dad-jokes_microservice">
                    <img src="https://img.shields.io/github/stars/yesinteractive/mocktainer?style=for-the-badge" alt="GitHub stars">
                </a> <a href="https://github.com/yesinteractive/dad-jokes_microservice">
                    <img src="https://img.shields.io/github/release/yesinteractive/mocktainer?style=for-the-badge" alt="GitHub release">
                </a> <img src="https://img.shields.io/badge/license-MIT-green?style=for-the-badge" alt="MIT"></p>
            <p>Mocktainer.io is a micro service that mocks micro service API's
 with fake data accross multiple endpoints representing various
 verticals and functions.</p>
            <h3>Hosted Service / Demo</h3>
            <p>Access <a href="http://mocktainer.io">http://mocktainer.io</a> to try the free hosted service.</p>
            <HR><h3>Usage</h3>
            <strong>Endpoints</strong>:
            <ul>
                <li>
                    <p><code>/</code> Root returns help and instructions in html format.</p>
                </li>
                <li>
                    <p><code>/accounts</code> Returns mock bank accounts in JSON</p>
                </li>
                <li>
                    <p><code>/customers</code> Returns mock customers in JSON</p>
                </li>
                <li>
                    <p><code>/employees</code> Returns mock employees in JSON</p>
                </li>
                <li>
                    <p><code>/inventory</code> Returns mock product inventory in JSON</p>
                </li>
                <li>
                    <p><code>/orders</code> Returns mock orders in JSON</p>
                </li>
                <li>
                    <p><code>/portfolio</code> Returns mock investment portfolio in JSON</p>
                </li>
                              <li>
                    <p><code>/prescriptions</code> Returns mock drug prescriptions in JSON</p>
                </li>
                <li>
                    <p><code>/trades</code> Returns mock trades</p>
                   
                </li>
            </ul>
           <p><strong>Echo URI</strong> : Simply add <code>/echo</code> to the end of any endpoint above to echo back
the original request with payload and request headers. Helpful for troublshooting.</p><BR
            <p><strong>Methods Supported</strong> : <code>GET</code> <code>PUT</code> <code>POST</code> <code>DELETE</code> <code>PATCH</code></p>
            <p><strong>Parameters</strong> : <code>?n=&lt;number&gt;</code> to specify number of records to return. Default is 10. Max is 250.</p>
            <p><strong>Successful Response</strong> : <code>200 OK</code></p>
            <pre><code class="json language-json">{
  "Results":  {
                  ...
              }
  "Request":  {
                  ...
              },
}</code></pre>
          <HR>
            <h3>Installation</h3>
            <h5>Deployment Examples</h5>
            <p>See usage examples for Kubernetes, Kong for Kubernetes Ingress Controller, and docker-compose in the <a href="https://github.com/yesinteractive/mocktainer/blob/master/examples">examples directory folder.</a></p>
            <h5>With Docker</h5>
            <p>Docker image is Alpine 3.11 based running PHP 7.3 on Apache. The container exposes both ports 80 an 443 with a self signed certificated. If you wish to alter the container configuration, feel free to use the Dockerfile in this repo (<a href="https://github.com/yesinteractive/mocktainer/blob/master/Dockerfile">https://github.com/yesinteractive/mocktainer/blob/master/Dockerfile</a>). Otherwise, you can pull the latest image from DockerHub with the following command:</p>
            <pre><code>docker pull yesinteractive/mocktainer</code></pre>
            <BR><p>Typical basic usage:</p>
            <pre><code>docker run -it yesinteractive/mocktainer</code></pre>
            <BR><p>Typical usage in Dockerfile:</p>
            <pre><code>FROM yesinteractive/mocktainer
RUN echo &lt;your commands here&gt;</code></pre>
            <HR>
            <h3>Adding New Endpoints</h3>
            <p>Adding a new endpoint is as simple as adding a new CSV file in the <a href="https://github.com/yesinteractive/mocktainer/tree/master/endpoints">endpoints</a> directory.
The name of the csv will be the dynamic endpoint. The first row must be column header names and 
there is no limit to the amount of columns. See examples in the controllers directory.</p>
           <HR>
             <h3>Contributing</h3>
            <p>If you have an endpoint to share, please add your submission via a <a href="https://github.com/yesinteractive/mocktainer/pulls">pull request</a>.</p>
        </div>
        <div ng-bind-html="trustedHtml" class="ng-binding" style="padding: 10; margin-left: 10;">
            <h3><br></h3>
        </div>
    </body>
</html>
