<?php

echo 2 + 2;

//phpinfo();

?>
<style>
    body {
        background: #666;
        color: #CCAA33;
    }

    #space {
        background: #333;
        position: relative;
    }

    .sprite {
        position: absolute;
        left: 0;
        top: 0;
    }
</style>
<body>
<div id="space"></div>
</body>
<script>


    function get(id) {
        return document.getElementById(id);
    }


    function create(elementType, content, attributes) {

        var e = document.createElement(elementType);

        if (attributes) {

            var keys = Object.keys(attributes);

            for (var i = 0; i < keys.length; i++) {
                var key = keys[i];
                var value = attributes[key];
                e.setAttribute(key, value);
            }

        }

        e.innerHTML = content;
        return e;

    }


    function place(space, elementType, content, attributes) {
        var s = create(elementType, content, attributes);
        space.element.appendChild(s);
        return s;
    }

    function Vector(x,y,z) {
        return {
            x: x, y: y, z: z
        }
    }

    function Space(width, height, element) {
        return {width: width, height: height, element: element};
    }


    function Sprite(positionVector, directionVector, element) {

        function updatePosition() {
            this.element.style.left = positionVector.x + 'px';
            this.element.style.top = positionVector.y + 'px';
        }

        return {
            updatePosition: updatePosition,
            element: element,
            position: positionVector,
            direction: directionVector
        }
    }


    function processSprite(s) {
        s.position.x += s.direction.x;
        s.position.y += s.direction.y;
        s.position.z += s.direction.z;
    }


    function processSpriteList() {

        var count = list.length;

        for (var i = 0; i < count; i++) {
            processSprite(list[i]);
        }

    }


    function createSprites(limit) {

        var list = [];
        var space = new Space(200, 200, get('space'));

        while (limit) {

            var directionX = Math.floor(Math.random() * space.width / 5);
            var directionY = Math.floor(Math.random() * space.height / 5);

            var positionX = Math.floor(space.width / 2);
            var positionY = Math.floor(space.height / 2);

            var e = place(space, 'div', '.', { 'class': 'sprite'});

            var d = new Vector(directionX,directionY,0);
            var p =  new Vector(positionX,positionY,0);

            var s = new Sprite(d, p, e);

            s.updatePosition();

            list.push(s);
            limit--;
        }
        window.spriteList

    }


    createSprites(12);

    requestAnimationFrame(function(){

    })
</script>