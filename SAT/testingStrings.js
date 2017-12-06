var word = "libertarian";
var def = "(adj.) advocating principles of liberty and free will (The dissatisfied subjects overthrew the monarch and replaced him with a libertarian ruler who respected their democratic principles.)"
var modifiedDef = def.replace(word, "*****");
console.log(modifiedDef);


var word = "rescind";
var def = "(v.) to take back, repeal (The company rescinded its offer of employment after discovering that Jane’s resume was full of lies.)"
var modifiedDef = def.replace(new RegExp(word, "i"), "*****");
console.log(modifiedDef);