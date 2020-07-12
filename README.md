# alt presskit()

Is a free (both as in speech and as in beer) alternative to the excellent [presskit()](http://dopresskit.com/)

## Why make an alternative?

Rami is one of the busiest people on earth, and while presskit() is pretty great, it's not perfect. By making a new version, using open source and the accompanying collaboration methods I hope to make it even better. Since this project was started, the [original presskit()](https://github.com/ramiismail/dopresskit) has gone open source. 

Pull requests are welcomed, but keep in mind the intent: Stay minimal and efficient. No bloat.

The idea is also to stay backwards compatible with the original, but this may change in the future. 

## Added features

* Responsive layout
* Pretty urls
* Valid HTML5
* Nice cropping of thumbnails

## Installation instructions

1. [Download the zip file](https://github.com/grapefrukt/altpresskit/archive/master.zip) and extract it. 
2. Make a copy of `config-defaults.php` and name it `config.php`, edit if needed
3. Add your `data.xml` to the data folder, [follow the instructions there if needed](https://github.com/grapefrukt/altpresskit/tree/master/data)
4. Upload to your server

## Useful tips

* You may sort your games in any order using the `<sort_order>1</sort_order>` tag in the game data.xml, lower numbers appear higher
* You may use a `<title>höledöwn</title>` tag in your game data.xml to use characters not suitable in directory names. 
* If you need to use html or other characters unsuitable for xml, wrap the tag contents in a CDATA tag:
```<link>
<![CDATA[ https://itunes.apple.com/us/app/holedown/id1297270249?ls=1&amp;mt=8 ]]>
</link>
```
* You may set the background color of the header using a `<color>#1f1824</color>` tag in the game data.xml

## Examples

https://presskit.grapefrukt.com/ uses this project

## Who made this?

* [Martin Jonasson](http://grapefrukt.com)
