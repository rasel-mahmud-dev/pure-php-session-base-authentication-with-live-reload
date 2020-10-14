



class Schema{
  constructor(props, instanceName){
    this.sync(instanceName);    
    this.instanceName = instanceName;    
    for (const key in props) {
      this.props= props
    }
  }

  sync(instanceName){
    console.log(squelize.force ? "force" : "" , " create tb ", instanceName );
    // console.log(this);
    
  }
}


class Squelize{  
  force = undefined;
  Schema = Schema;
  sync(force){
    this.force = force
  }
}


let squelize = new Squelize();
squelize.sync(true);

let userSchema  = new squelize.Schema({username:"string", id:"int",}, "users");
let productSchema  = new squelize.Schema({name:"string", id:"int",}, "products");


function model(schema){
  return class Base{
    schema=schema;
    constructor(obj){
      this.obj = obj    
    }

    save(){
      let needKeys = Object.keys(this.schema.props);
      let sql = 'Insert Into ' + this.schema.instanceName + "("
      let val = 'Values ' + "("

      function checkType(data){
        if(typeof data === "string"){
          return `"${data}",`
        }
        return data + ","
      };
      function cutEndComma (str){
        str = str + ")"
        return str.replace(",)", ")")      
      };

      for (const key in this.obj) {
      if(needKeys.indexOf(key) !== -1){
        sql = sql + " " + key;
        val = val + " " + checkType(this.obj[key]);
      }
      }
      
      val = cutEndComma(val);
      sql = cutEndComma(sql);
      const query = sql + val;
      console.log(query);    
    }

    static find(){
      console.log("SELECT * FROM ", schema.instanceName );
    }

    static findById(userId){
      console.log("SELECT * FROM ", schema.instanceName + " WHERE id = " + userId );
    }
  }
}


class User extends model(userSchema){

  static myCustomMethod(){
    console.log("this is custom method");    
  }
}


class Product extends model(productSchema){

}

let newUser = new User({username: "A", id: 123});
newUser.save()
