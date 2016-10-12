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
                    ->objectID(UOID::createUOID())
                    ->targetID($albumID)
                    ->mimetype($image->getClientMimeType())
                    ->type("image")
                    ->url(Auth::user()->socialrecord->profileLocation . 'albums/' . $filename)
                    ->build();

```
