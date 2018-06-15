# 閉包、高階函數

## 閉包
### 閉包 vs es6
    // 一般寫法(會出錯) ->[4,4,4,4]
    for(var i=0;i<4;i++){
        setTimeout(()=>{
            console.log(i)
        },100)
    }

    // 閉包寫法 ->[0,1,2,3]
    for(var i=0;i<4;i++){
        (function(i){
            return setTimeout(()=>{
                console.log(i)
            },100)
        })(i)
    }

    // es6寫法 ->[0,1,2,3]
    for(let i=0;i<4;i++){
        setTimeout(()=>{
            console.log(i)
        },100)
    }

### 閉包 vs class
    // 閉包寫法(可將value想成是class的私有屬性)
    var extent = function(){
        var value = 0;
        return {
            call: function(){
                value++;
                console.log( value );
            } 
        }
    };
    var extent = extent();
    extent.call(); // 输出：1
    extent.call(); // 输出：2
    extent.call(); // 输出：3 

    // 閉包寫法(可將value想成是class的public屬性)
    var extent = {
        value: 0,
        call: function(){
            this.value++;
            console.log( this.value );
        }
    };
    extent.call(); // 输出：1
    extent.call(); // 输出：2
    extent.call(); // 输出：3 


    // class寫法
    var Extent = function(){
        this.value = 0;
    };
    Extent.prototype.call = function(){
        this.value++;
        console.log( this.value );
    };
    var extent = new Extent();
    extent.call();
    extent.call();
    extent.call();

    // es6 class寫法
    class Extent{
        constructor(){
            let value = 0
            this.call = ()=>{
                value++
                console.log(value)
            }
        }
    }
    let extent = new Extent()
    extent.call()
    extent.call()
    extent.call()

## 高階函數  
### ex. callback 使用
    var test = function( callback ){
        for ( var i = 0; i < 100; i++ ){
            console.log('this is main:'+i)
            if ( typeof callback === 'function' ){
                callback( i );
            }
        }
    };
    test(function( num ){
        console.log("this is callback:"+num)
    }); 

### ex. array sort 使用
    let test = [ 1, 4, 3 ].sort( function( a, b ){
        return a - b; 
    }); 
    console.log(test)

### ex. AOP 面相切面編程 使用
    Function.prototype.before = function( beforefn ){
        var __self = this; // 保存原函数的引用
        return function(){ // 返回包含了原函数和新函数的"代理"函数
            beforefn.apply( this, arguments ); // 执行新函数，修正 this
            return __self.apply( this, arguments ); // 执行原函数
        }
    };
    Function.prototype.after = function( afterfn ){
        var __self = this;
        return function(){
            var ret = __self.apply( this, arguments );
            afterfn.apply( this, arguments );
            return ret;
        }
    };
    var func = function(){
        console.log( 2 );
    };
    func = func.before(function(){
        console.log( 1 );
    }).after(function(){
        console.log( 3 );
    });
    func(); 

## currying
    // curry概念
    var cost = (function(){
        var args = [];
        return function(){
            if ( arguments.length === 0 ){
                var money = 0;
                for ( var i = 0, l = args.length; i < l; i++ ){
                    money += args[ i ];
                }
                return money;
            }else{
                [].push.apply( args, arguments );
            }
        }
    })();
    cost( 100 ); // 未真正求值
    cost( 200 ); // 未真正求值
    cost( 300 ); // 未真正求值
    console.log( cost() ); // 求值并输出：600

    // curry 實作函數
    var currying = function( fn ){
        var args = [];
        return function(){
            if ( arguments.length === 0 ){
                return fn.apply( this, args );
            }else{
                [].push.apply( args, arguments );
                return arguments.callee;
            }
        }
    };
    var cost = (function(){
    var money = 0;
    return function(){
        for ( var i = 0, l = arguments.length; i < l; i++ ){
            money += arguments[ i ];
        }
        return money;
        }
    })();
    var cost = currying( cost ); // 转化成currying 函数
    cost( 100 ); // 未真正求值
    cost( 200 ); // 未真正求值
    cost( 300 ); // 未真正求值
    console.log ( cost() ); // 求值并输出：600
