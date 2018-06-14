# 第一章

## 宣告 class, 繼承
    let Father = function(name){
        let _age = 50
        this.getAge = ()=>{
            return _age
        }
        this.getName = ()=>{
            return name
        }
        this.speak = ()=>{
            console.log('we are family')
        }
    }
    let Child = function(name){
        Father.apply(this,['john'])
        let _age = 20
        this.getAge = ()=>{
            return _age
        }
        this.getName = ()=>{
            return name
        }
    }

    let childA = new Child('peter')

    console.log(childA.getName())
    console.log(childA.getAge())
    childA.speak()
## 多態
    class Cat{
        constructor(){
            this.speak = ()=>{
                console.log('meow')
            }
        }
    }

    class Dog{
        constructor(){
            this.speak = ()=>{
                console.log('woof')
            }
        }
    }

    let doSpeak = (animal)=>{
        if(animal.speak instanceof Function){
            animal.speak()
        }
    }

    let d = new Dog()
    let c = new Cat()

    doSpeak(c)
    
## clone創建對象(原型模式)
    Object.create = Object.create || function( obj ){
        var F = function(){};
        F.prototype = obj;
        return new F();
    } 
    let Plane = function(){
        this.blood = 100;
        this.attackLevel = 1;
        this.defenseLevel = 1;
    };
    let plane = new Plane();
    plane.blood = 500;
    plane.attackLevel = 10;
    plane.defenseLevel = 7;
    let clonePlane = Object.create( plane );
    console.log( clonePlane ); 

## es6 物件導向
    class Animal{
        constructor(name) {
            this.name = name;
        }
        getName(){
            return this.name
        }
    }

    class Dogs extends Animal{
        constructor(name) {
            super(name);
            let _content = "woof"
            this.speak = ()=>{
                console.log(_content)
            }
        }
    }

    let test = new Dogs('test');
    test.speak()
    console.log(test.getName())

