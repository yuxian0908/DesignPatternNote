#第二章

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