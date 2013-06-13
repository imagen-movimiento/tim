/* Author:
furenku
*/

// tomada de : http://stackoverflow.com/questions/12610394/javascript-classes

// var Foo = (function() {
    
//     var _x;
//     var _x;

//     // constructor
//     function Foo(){
//         this._x = "some value";
//         this._y = "some value";
//     };

//     // add the methods to the prototype so that all of the 
//    
//     Foo.prototype.getX = function() {
//         return this._x;
//     };
//     Foo.prototype.setX = function(x) {
//         this._x = x;
//     };
//     Foo.prototype.getY = function() {
//         return this._y;
//     };
//     Foo.prototype.setY = function(y) {
//         this._y = y;
//     };

//     return Foo;

// })();




var Foo = (function() {
    
    // constructor
    function Foo(){
        
        this._x =  Math.floor((Math.random()*1200)+1);;
        this._y =  Math.floor((Math.random()*800)+1);;
        this._z = 1;
        this._s = 10;
        this._o = 1;

    };

    // var paper,circle;

    // add the methods to the prototype so that all of the 
   
    Foo.prototype.getX = function() {
        return this._x;
    };
    Foo.prototype.setX = function(x) {
        this._x = x;
    };   
    Foo.prototype.getY = function() {
        return this._y;
    };
    Foo.prototype.setY = function(y) {
        this._y = y;
    };   
    Foo.prototype.getZ = function() {
        return this._z;
    };
    Foo.prototype.setZ = function(z) {
        this._z = z;
    };   
    Foo.prototype.getS = function() {
        return this._s;
    };
    Foo.prototype.setS = function(s) {
        this._s = s;
    };   
    Foo.prototype.getO = function() {
        return this._o;
    };
    Foo.prototype.setO = function(o) {
        this._o = o;
    };


    Foo.prototype.move = function() {
        var x = this._x;
        var y = this._y;

        var rndmX = Math.random()*3;
        var rndmY = Math.random()*3;
        rndmX -= 1.5;
        rndmY -= 1.5;


        this._x = x + rndmX;
        this._y = y + rndmY;

       
    };

        return Foo;
    
    })();


// var a = new Foo();
// var b = new Foo();
// a.setX(20);
// b.setBar('b');
// alert(a.getX()); // alerts 'a' :) 
// alert(b.getX()); // alerts 'b' :) 


// var anim = Raphael.animation()





    var arr = Array();
    var crcs = Array();
    var paths = Array();
    var ppaths = Array();


$j = jQuery.noConflict();

$j(document).ready( function(){


    /* header */

    var h = $j("#menu");

    // Creates canvas 320 × 200 at 10, 50
    var paperH = Raphael(h.attr('id'), h.attr('width'), h.attr('height') );


    var tim = "imagen-movimiento";

    for (var i = 0; i < tim.length; i++) {
        paperH.text(50+(40 * i), 10,tim.charAt(i)).attr({ stroke: "#fafbfc", 'stroke-width': 1});        ;
    };

    // var width = parseInt( f.css('width') );
    // var noSteps = 10;
    // var stepX = width / noSteps;
    // var paddingX = stepX / 2;

    // var cX = width / 2;
    



    // for (var i = 0; i < 10; i++) {
    //     var foo = paper.path(['M',i*stepX,0,40).attr({fill: "#333",  stroke: "#252525", 'stroke-width': 1, cursor: "pointer"});
    //     foo.setX( ( i * stepX ) + paddingX );

    //     arr.push( foo );

    // };



    // for(var i = 0; i < arr.length; i++){
    //     // alert(arr[i].getX());
    //     var c = paper.circle( arr[i].getX(), arr[i].getY(), 20, 20).attr({fill: "#333",  stroke: "#252525", 'stroke-width': 1, cursor: "pointer"});
    //     var g = c.glow({opacity: 1.0, color: "#333", width: 10});
    //     var p = paper.path('M0 0L0 0').attr({ stroke: "#833260", 'stroke-width': 1});        
    //     var pp = paper.path('M0 0L0 0').attr({ stroke: "#525252", 'stroke-width': 1});                
    //     crcs.push( c );
    //     paths.push( p );
    //     ppaths.push( pp );
    //     setInterval( function(){ move(crcs,paper); }, 100 );
        
    // }



    /* fondo principal */

    var f = $j("#fullscreen");
    // Creates canvas 320 × 200 at 10, 50
    var paper = Raphael(f.attr('id'), f.attr('width'), f.attr('height') );


    var width = parseInt( f.css('width') );
    var noItems = 4;
    var stepX = width / noItems;
    var paddingX = stepX / 2;

    var cX = width / 2;
    // var circle1 = paper.circle(cX,50,40).attr({fill: "#333",  stroke: "#252525", 'stroke-width': 1, cursor: "pointer"});

    // var g = circle1.glow({opacity: 1.0, color: "#333", width: 10});




    for (var i = 0; i < noItems; i++) {
        var foo = new Foo( paper );
        foo.setX( ( i * stepX ) + paddingX );

        arr.push( foo );

    };



    for(var i = 0; i < arr.length; i++){
        // alert(arr[i].getX());
        var c = paper.circle( arr[i].getX(), arr[i].getY(), 20, 20).attr({fill: "#333",  stroke: "#252525", 'stroke-width': 1, cursor: "pointer"});
        // var g = c.glow({opacity: 1.0, color: "#333", width: 10});
        // c.hide();
        var p = paper.path('M0 0L0 0').attr({ stroke: "#233260", 'stroke-width': 1});        
        var pp = paper.path('M0 0L0 0').attr({ stroke: "#525252", 'stroke-width': 1});                
        crcs.push( c );
        paths.push( p );
        ppaths.push( pp );
        setInterval( function(){ move(crcs,paper); }, 100 );
        
    }

}); 



function move(){
    
    for(var i = 0; i < crcs.length; i++){
        // alert(arr[i].getX());
       var c = crcs[i];
       var p = paths[i];
       var pp = ppaths[i];
       // alert(c);
       var foo = arr[i];
       var bar = arr[(i+1)%crcs.length];

       foo.move();

       var x = foo.getX();
       var y = foo.getY();

       var x2 = bar.getX();
       var y2 = bar.getY();

       var anim = Raphael.animation({cx: x2, cy: y2}, 100, 'ease-in' );
       
// var hatp = paper.path('M100 100L200 200');
        var newPath = "M"+Math.floor(x)+" "+Math.floor(y)+"L"+Math.floor(x2)+" "+Math.floor(y2);//].join(' ');

// var pt = paper.path(newPath).attr({ stroke: "#ffffff", 'stroke-width': 100}); 
// p.attr({ path : newPath });
       p.animate({path:'M'+x+' '+y+'L0 0'},100);
       
       pp.animate({path:newPath},50);
       // c.animate({transform: "t"+x+","+y}, 100 );

       c.animate(anim);



    }
    

} 
function moveHeader(){
    
    for(var i = 0; i < crcs.length; i++){
        // alert(arr[i].getX());
       var c = crcs[i];
       var p = paths[i];
       var pp = ppaths[i];
       // alert(c);
       var foo = arr[i];
       var bar = arr[(i+1)%crcs.length];

       foo.move();

       var x = foo.getX();
       var y = foo.getY();

       var x2 = bar.getX();
       var y2 = bar.getY();

       var anim = Raphael.animation({cx: x2, cy: y2}, 100, 'ease-in' );
       
// var hatp = paper.path('M100 100L200 200');
        var newPath = "M"+Math.floor(x)+" "+Math.floor(y)+"L"+Math.floor(x2)+" "+Math.floor(y2);//].join(' ');

// var pt = paper.path(newPath).attr({ stroke: "#ffffff", 'stroke-width': 100}); 
// p.attr({ path : newPath });
       p.animate({path:'M'+x+' '+y+'L0 0'},100);
       
       pp.animate({path:newPath},50);
       // c.animate({transform: "t"+x+","+y}, 100 );

       c.animate(anim);



    }
    

}


