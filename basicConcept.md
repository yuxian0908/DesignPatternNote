# 第二章

## call, apply, this
    let dog = {
        name : "steve",
        getName : function(){
            return this.name
        }
    }

    let test = dog.getName
    console.log(dog.getName())
    console.log(test())
    console.log(test.apply(dog))

## closure(封包)
    // 全局變量寫法
    let cache = {};
    let mult = function(){
        let args = Array.prototype.join.call( arguments, ',' );
        if ( cache[ args ] ){
            return cache[ args ];
        }
        let a = 1;
        for ( let i = 0, l = arguments.length; i < l; i++ ){
            a = a * arguments[i];
        }
        return cache[ args ] = a;
    };
    console.log ( mult( 1,2,3 ) ); // 输出：6

    // 封包寫法
    let mult2 = (function(){
        let cache = {}
        return function(){
            var args = Array.prototype.join.call( arguments, ',' );
            if ( cache[ args ] ){
                return cache[ args ];
            }
            var a = 1;
            for ( var i = 0, l = arguments.length; i < l; i++ ){
                a = a * arguments[i];
            }
            return cache[ args ] = a;
        }
    })()
    console.log ( mult2( 1,2,3 ) ); // 输出：6

    
    // class寫法
    class mult3{
        constructor(){
            let cache = {}
            this.cul = function(){
                var args = Array.prototype.join.call( arguments, ',' );
                if ( cache[ args ] ){
                    return cache[ args ];
                }
                var a = 1;
                for ( var i = 0, l = arguments.length; i < l; i++ ){
                    a = a * arguments[i];
                }
                return cache[ args ] = a;
            }
        }
    }
    let test = new mult3()
    console.log(test.cul(1,2,3));
