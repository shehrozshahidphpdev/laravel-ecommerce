let promise = new Promise((resolve, reject) => {
    setTimeout(function(){
      console.log("promise called")
      resolve();
    }, 1000)
})

promise.then(function() {
  console.log('promise resolved');
})