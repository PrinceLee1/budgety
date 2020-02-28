$(function () {
  $(document).scroll(function () {
    var $nav = $(".navbar-fixed-top");
    $nav.toggleClass('scrolled', $(this).scrollTop() > $nav.height());

  });
});

//This part handles the budget or can be called the budget controller
var budgetController = (function(){

  var Expense = function(id, description, value){
    this.id = id;
    this.description = description;
    this.value = value;
  }
  var Income = function(id, description, value){
    this.id = id;
    this.description = description;
    this.value = value;
  }
var calculateTotal = function(type){
  var sum = 0;
  data.allItems[type].forEach(function(cur){
sum += cur.value
  }); 
  data.totals[type] = sum;
}
var data = {
  allItems : {
  exp : [],
  inc : []
  },

totals : {
exp : 0,
inc : 0
  },
  budget : 0,
  percentage : -1

}

return { 
 addItem:function(type, des, val){
   var newItem, ID;
   //Create new Id
if(data.allItems[type].lenght > 0){
  ID = data.allItems[type][data.allItems[type].lenght -1].id + 1;
}else{
  ID = 0; 
}

//Create new Item based on "expenses" or "income"
   if (type === 'exp'){
     newItem = new Expense(ID,des,val);
   }else if(type === 'inc'){
     newItem = new Income(ID,des, val)
   }
   //Add or push new Item to our data structure
   data.allItems[type].push(newItem);
   //And also return it
   return newItem;
 },

 deleteItem : function(type, id){
var ids, index;
 ids = data.allItems[type].map(function(current){
return current.id;
});
index = ids.indexOf(id);
if(index !== -1){
data.allItems[type].splice(index,1)
}
 },
 calculateBudget: function(){
//Calculate the total income and expenses
calculateTotal('exp');
calculateTotal('inc');
// Calculate budget: income - expenses
data.budget = data.totals.inc - data.totals.exp;
//Calculate the percentage of income spent
if(data.totals.inc > 0){
  data.percentage = Math.round((data.totals.exp / data.totals.inc) * 100);
}else{
  data.percentage = -1;   
}

 },
 getBudget : function(){
return {
  budget : data.budget,
  totalInc : data.totals.inc,
  totalExp : data.totals.exp,
  percentage : data.percentage
}
 },
 testing : function(){
   console.log(data);
 }
}
})();

//End of budgetController


//This part handles the UI like getting input data's and making changes to the UI
var UIController = (function(){
  var DOMstrings = {
    inputType: '.add__type',
    inputDescription : '.add__description',
    inputValue : '.add__value',
    inputBtn : '.add__btn',
    incomeContainer: '.income__list',
    expensesContainer: '.expenses__list',
    budgetLabel : '.budget__value',
    incomeLabel : '.budget__income--value',
    expensesLabel : '.budget__expenses--value',
    percentageLabel : '.budget__expenses--percentage',
    container : '.container-fluid'

  };
return{
  getInput : function(){
    return{
    type :document.querySelector(DOMstrings.inputType).value,
    description: document.querySelector(DOMstrings.inputDescription).value,
    value :parseFloat(document.querySelector(DOMstrings.inputValue).value)
    //The parseFloat() method converts a string to a floating number basically a decimal number and this is used to make the calculations of the budget possible, since you can't perform calculations with strings.
    };
  },
addListItem: function(obj, type){
var html,newHtml, element;
  //Create HTML strings with placeholder text
  if(type === 'inc'){
    element = DOMstrings.incomeContainer;

     html = '<div class="item clearfix" id="inc-%id%"><div class="item__description">%description%</div><div class="right clearfix"><div class="item__value">%value%</div> <div class="item__delete">  <button class="item__delete--btn"><i class="ion-ios-close-outline"></i></button></div></div></div>'; 
  }else if(type ==='exp'){
    element = DOMstrings.expensesContainer;
html = '<div class="item clearfix" id="exp-%id%"><div class="item__description">%description%</div><div class="right clearfix"><div class="item__value">%value%</div> <div class="item__percentage">21%</div><div class="item__delete"><button class="item__delete--btn"><i class="ion-ios-close-outline"></i></button></div> </div></div>'

  }
  //Replace the placeholder with some actual text
newHtml = html.replace('%id%',obj.id);
newHtml = newHtml.replace('%description%',obj.description);
newHtml = newHtml.replace('%value%',obj.value);

  //Insert HTML into the DOM
  document.querySelector(element).insertAdjacentHTML('beforeend',newHtml);
},
deleteListItem: function(selectorID){
  var el = document.getElementById(selectorID);
el.parentNode.removeChild(el);
},

clearInputFields: function(){
  var fields,fieldsArray;
  fields = document.querySelectorAll(DOMstrings.inputDescription + ',' + DOMstrings.inputValue);
  fieldsArray = Array.prototype.slice.call(fields);
  fieldsArray.forEach(function(currentVal, index, array){
currentVal.value = "";
  });
  fieldsArray[0].focus();
},
displayBudget : function(obj){
document.querySelector(DOMstrings.budgetLabel).textContent = obj.budget;
document.querySelector(DOMstrings.incomeLabel).textContent = obj.totalInc;
document.querySelector(DOMstrings.expensesLabel).textContent = obj.totalExp;

if(obj.percentage > 0){
  document.querySelector(DOMstrings.percentageLabel).textContent = obj.percentage + "%";
}else{
  document.querySelector(DOMstrings.percentageLabel).textContent = '----';
}
},
  getDOMstrings : function(){
    return DOMstrings;
  }
}


})();
//End of the UIController

//This part handles the control,like connecting both the UI controller and the Budget controller
var controller = (function(budgetCtrl, UICtrl){

  var setupEventListeners = function(){
    var DOM = UICtrl.getDOMstrings();
    document.querySelector(DOM.inputBtn).addEventListener('click',ctrlAddItem);
 
    document.addEventListener('keypress', function(event){
      if (event.keyCode === 13 || event.which === 13){
        ctrlAddItem();
      }
    });
    document.querySelector(DOM.container).addEventListener('click',ctrlDeleteItem)
  };

var updateBudget = function(){
 //1.Calculate the budget
budgetCtrl.calculateBudget();
//2. Return the budget
var budget = budgetCtrl.getBudget();
   //5.Display the budget in the UI
UICtrl.displayBudget(budget);
}
 
    var ctrlAddItem = function(){
      var input, newItem;
      //1. Get the feild input data
 input = UICtrl.getInput();
 if(input.description !== "" && !isNaN(input.value) && input.value > 0){
     //2.Add the item to the budget controller
newItem = budgetController.addItem(input.type,input.description, input.value);
//3.Add the item to the UI 
UICtrl.addListItem(newItem,input.type);
// 4. Clear Fields
UICtrl.clearInputFields();
// 5. Calculate and Update budget
updateBudget();
 }else{alert('Please add a Description and Value.Value should be greater than 0')}
    };
    var ctrlDeleteItem = function(event){
      var itemID,splitID,type,ID;
     itemID = event.target.parentNode.parentNode.parentNode.parentNode.id;
     if(itemID){
       splitID = itemID.split('-');
       type = splitID[0];
       ID = parseInt(splitID[1]);

       //1. Delete the Item from the data structure
       budgetCtrl.deleteItem(type, ID);
       //2. Delete the item from the UI
UICtrl.deleteListItem(itemID);
       //3. Update and show the new budget
       updateBudget();
     }
    }
    return {
init: function(){
  console.log('Application Has Started');
  UICtrl.displayBudget({
    budget : 0,
  totalInc : 0,
  totalExp : 0,
  percentage : -1
  });

  setupEventListeners();
}
    }
})(budgetController,UIController);

controller.init();