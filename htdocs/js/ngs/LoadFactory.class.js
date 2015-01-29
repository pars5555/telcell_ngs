ngs.LoadFactory= Class.create();
ngs.LoadFactory.prototype={
	
	initialize: function(ajaxLoader){
		this.loads = [];
		this.loads["main"] = function temp(){return new ngs.MainLoad("main", ajaxLoader);};
		this.loads["home"] = function temp(){return new ngs.HomeLoad("home", ajaxLoader);};
		this.loads["beeline"] = function temp(){return new ngs.BeelineLoad("beeline", ajaxLoader);};
		this.loads["orange"] = function temp(){return new ngs.OrangeLoad("orange", ajaxLoader);};
		      
		},
	
	getLoad: function(name){
		try{
			return this.loads[name]();
		}
		catch(ex){
		}
	}
};