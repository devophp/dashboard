# Devophp Dashboard

This application provides a dashboard into various devophp related services and applications

**NOTE** This project is very new, and not yet ready to use. But feel free to join and contribute!

## Design goals

* Develop a set of independant devops related administration bundles
* Use the `Dashboard` project to include all available devophp bundles

## Target bundles

The following bundles are on the wishlist:

### DevophpMainBundle

General / reusable screens (login, setup, help, etc)

### DevophpEtcdBundle

Manage [Etcd](https://github.com/coreos/etcd) configuration data, supporting multiple etcd clusters.

### DevophpDockerBundle

Manage Docker hosts, using [Docker remote API](http://docs.docker.io/en/latest/api/docker_remote_api/)

### DevophpMetricsBundle

Monitor remote hosts, containers and application through metrics. Collector agents send basic system data, while applications submit metrics directly. Optionally relay to statsd / graphite.

### DevophpAlertBundle

Monitor metrics, and trigger notifications when tresholds get exceeded.

### DevophpBuildBundle

Trigger builds, initially through Jenkins

### DevophpDeployBundle

Deploy new application releases to selected nodes.

### DevophpFirewallBundle

Configure firewalling rules in a way similar to AWS security groups.

## Quick installation

1. clone this repo to your local system: `git clone git://github.com/devophp/dashboard`, `cd dashboard`
2. Pull in dependencies using `composer install`
3. Install bundle assets in web directory `app/console assets:instal`
4. Run simple server php app/console server:run
5. Browse to http://localhost:8000/

