# 單例模式(懶漢式)
## 不透明的單例模式(使用者必須知道這是個單例，不然直接new會出問題)
    var Singleton = function( name ){
        this.name = name;
        this.instance = null;
    };
    Singleton.prototype.getName = function(){
        console.log( this.name );
    };
    Singleton.getInstance = function( name ){
        if ( !this.instance ){
            this.instance = new Singleton( name );
        }
        return this.instance;
    };
    var a = Singleton.getInstance( 'sven1' );
    var b = Singleton.getInstance( 'sven2' );
    console.log(a===b); // true

## 透明的單例
    let Singleton = (function( name ){
        let instance = null
        this.name = name;
        this.instance = null;
        let Singleton = function(name){
            if(instance){
                return instance
            }
            this.name = name
            this.init()
            return instance = this
        }
        Singleton.prototype.init = function(){}
        return Singleton
    })();
    var a = new Singleton( 'sven1' );
    var b = new Singleton( 'sven2' );
    console.log(b);
    console.log(a)
    console.log(a===b); // true

## es6 懶漢式
    class Universe {
        constructor(name) {
            if (Universe._getInstance()) return Universe._getInstance();
            this.name = name;
            Universe._getInstance(this);
        }
    }
    Universe._getInstance = (function () {
        return (newInstance) => {
        if (newInstance) Universe._instance = newInstance;
        return Universe._instance;
        }
    }());

    let u1 = new Universe("2");
    let u2 = new Universe("3");

    console.log(Universe)
    console.log(u1.name); //'bar'
    console.log(u1 === u2); //true

## es6 惡漢式
    class Universe {
        constructor(name) {
            if (Universe._getInstance()) return Universe._getInstance();
            this.name = name;
            Universe._getInstance(this);
        }
    }
    Universe._getInstance = (function () {
        return (newInstance) => {
        if (newInstance) Universe._instance = newInstance;
        return Universe._instance;
        }
    }());
    Universe._instance = new Universe("1")

    let u1 = new Universe("2");
    let u2 = new Universe("3");

    console.log(Universe)
    console.log(u1.name); //'bar'
    console.log(u1 === u2); //true

## php 懶漢式
    <?php
    class Singleton{
        private static $instance;
        public static function getInstance(): Singleton{
            if (null === static::$instance) {
                static::$instance = new static();
            }

            return static::$instance;
        }
        private function __construct(){}
        private function __clone(){}
        private function __wakeup(){}

        
        public function getName(){
            return "jimmy";
        }
    }

    $test = Singleton::getInstance();
    var_dump($test);
    ?>