# Buto-Plugin-RoleFlash
Role map.
## Settings
In theme settings.yml.
```
role:
  item:
    -
      name: webmaster
      description: Handle application files and settings.
    -
      name: webadmin
      description: Handle application content.
```
## Widget
```
type: widget
data:
  plugin: role/flash
  method: show
```
