ElementMVar1 = "span"
ElementNewVar = new Element(ElementMVar1);
mycurrentVar = "current";
myhoverVar = "hover_fun";
mypositionVar = "top";
ElementMVar2 = "main-menu";
ElementMVar3 = "li a";
window.addEvent('domready', function() {
	myelementVar = $(ElementMVar2).getElement(ElementMVar3);
	myelementsVar = $(ElementMVar2).getElements(ElementMVar3);
	myelementVar.addClass(mycurrentVar);
	myelementVar.addClass(myhoverVar);
	ElementNewVar.inject(myelementVar, mypositionVar);
	myelementsVar.addEvent('mouseenter', myFunaddspan);
});
var myFunaddspan = function () {
	ElementNewVar.inject(this, mypositionVar);
	myelementsVar.removeClass(mycurrentVar);
	myelementsVar.removeClass(myhoverVar);
	this.addClass(mycurrentVar);
	this.addClass(myhoverVar);
}