# extensions
extensions for the Sonic SDK
this includes

MediaItem Object
Album Object

# Setup

    ./composer require senansharhan/extensions

or configure your composer.json accordingly

    "require" : { "senansharhan/extensions": "dev-master" }

## Usage

```php
    use senansharhan\extensions\src\Model\AlbumObjectBuilder;
    use senansharhan\extensions\src\Model\MediaItemObjectBuilder;
    
     $MediaItemObject = (new MediaItemObjectBuilder())
                    ->objectID("15P67P1BMDKE6J9OQC8IVT7PSIFW4M094AE2MG1LWJD6MO8GUP:1e082f14b9e4462e")
                    ->targetID("15P67P1BMDKE6J9OQC8IVT7PSIFW4M094AE2MG1LWJD6MO8GUP:56dcdaff4a03d135")
                    ->mimetype("image/jpeg")
                    ->type("image")
                    ->url("exampel.com/api/albums/image1.jpg")
                    ->build();

```
