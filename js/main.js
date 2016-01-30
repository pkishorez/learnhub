/*
 * Author	: kishore
 *
 * **ABOUT**
 * 
 * =============================
 *           NOTES
 * =============================
 *
 */


/**
 * This structure is nothing but an encapsulation of both functionalities
 * and data of courses. To display, filter, get the records from server etc
 * functions are defined here.
 */
var courses = {
	xhr : null,
	categories : [],
	types : [],
	order : "",
	orderby: "",
	
	/**
	 * Render the course list in right pane of courses from the json array.
	 * @param {type} jsons : json array that consists of list of courses.
	 * 
	 * This function takes json array, and iterates over each json.
	 * To each json, it clones the course template, sets the fields
	 * of template according the json values and appends the cloned template
	 * to the course list..
	 */
	render : function(jsons){
		var i=0;
		$("#searchstats").html("<b>"+jsons.length+"</b> results found.");
		var course = $("#course_template");
		$("#courses").html("");
		for (i=0; i<jsons.length; i++)
		{
			var json = jsons[i];

			var ncourse = course.clone();
			//$(ncourse).addClass(json.type.toLowerCase().trim());
			$(ncourse).attr("href", json.url);
			$(".image", ncourse).attr("src", json.image);
			$(".contents .title", ncourse).html(json.title);
			$(".contents .description", ncourse).html(json.description);

			var price = json.price;
			if (price.search("INR /month")){
				price = price.replace("INR /month", "");
				if (price.substr(0, 3)==="Rs."){
					price = price.replace("Rs.", "");
				}
				price = price.trim();
			}
			$(".contents .cost .value", ncourse).html(price);
			$(".contents .type", ncourse).html(json.type);
			$(".contents .category", ncourse).html(json.category);
			$("#courses").append(ncourse);
		}
	},
	
	/**
	 * This function gives an indication of loading while fetching the 
	 * data from server.
	 */
	loading : function()
	{
		$("#searchstats").html("<div style='color:red'>Loading... please wait.</div>");
	},
	
	post : function(url, data, func)
	{
		if (courses.xhr!=null){
			courses.xhr.abort();
			courses.xhr=null
		}
		courses.xhr = $.post(url, data, function(d){
			func(d);
		}, "json");
	},
	/**
	 * Gets and renders the list of courses from the server.
	 */
	get : function()
	{
		courses.post(base_path+"/courses?ajax=true", null, function(data){
			courses.render(data);	
		});
	},
	
	/**
	 * Search specific course.
	 */
	search: function()
	{
		
	},
	
	/**
	 * Sorts the list of courses based on `order` attribute in asceding
	 * or descending that is decided by order by.
	 * @param {type} order : attribute based on which the list should be sorted.
	 * @param {type} orderby : asc or desc
	 */
	sort: function(order, orderby)
	{
		courses.loading();
		courses.order = order;
		courses.orderby = orderby;
		courses.post(base_path+"/courses/filter?ajax=true", {
			"types" : courses.types,
			"categories" : courses.categories,
			"order" : order,
			"orderby" : orderby
		}, function(data){
			courses.render(data);
		});
	},
	
	/**
	 * Filters the list of courses based on the criteria given.
	 */
	filter: function()
	{
		courses.loading();
		var types = [], categories=[];
		
		$(".filters .categories input[type='checkbox']:checked").each(function(){
			categories.push($(this).val());
		});
		$(".filters .types input[type='checkbox']:checked").each(function(){
			types.push($(this).val());
		});
		
		courses.categories = categories;
		courses.types = types;
		

		courses.post(base_path+"/courses/filter?ajax=true", {
			"types" : types,
			"categories" : categories,
			"order" : courses.order,
			"orderby" : courses.orderby
		}, function(data){
			courses.render(data);
		});
	}
};

/**
 * Register some basic functionality on page load.
 */
$(document).ready(function(){
	$(".filters .categories input[type='checkbox']").change(function(){
		courses.filter();
	});
	$(".filters .types input[type='checkbox']").change(function(){
		courses.filter();
	});
	
	$(".rightpane .sort").data("sort", "none");
	$(".rightpane .sort").click(function(){
		$(".rightpane .sort i").attr("class", "fa fa-sort-numeric-asc");
		$(".rightpane .sort").removeClass("highlight");
		var sort = $(this).data("sort");
		$(".rightpane .sort").data("sort", "none");
		
		if (sort=="none"){
			$(this).addClass("highlight");
			$("i", this).attr("class", "fa fa-sort-numeric-asc");
			courses.sort($(this).attr("data-order"), "asc");
			$(this).data("sort", "asc");
		}
		else if (sort=="asc"){
			$(this).addClass("highlight");
			$("i", this).attr("class", "fa fa-sort-numeric-desc");
			courses.sort($(this).attr("data-order"), "desc");
			$(this).data("sort", "desc");
		}
		else{
			$(this).removeClass("highlight");
			$("i", this).attr("class", "fa fa-sort-numeric-asc");
			courses.sort("", "");
			courses.filter();
			$(this).data("sort", "none");
		}
	})
	courses.get();
});