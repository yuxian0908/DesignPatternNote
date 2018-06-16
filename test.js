class strategyA{
    constructor(){}
    speak(){
        console.log("i am man")
    }
}
class strategyB{
    constructor(){}
    speak(){
        console.log("i am woman")
    }
}
class strategyC{
    constructor(){}
    speak(){
        console.log("i dont know who i am")
    }
}

class whoIam{
    constructor(req){
        let strategy = req
        this.define = ()=>{
            strategy.speak()
        }
    }
}

let male = new whoIam(new strategyA())
male.define()
let female = new whoIam(new strategyB())
female.define()
let unknow = new whoIam(new strategyC())
unknow.define()
