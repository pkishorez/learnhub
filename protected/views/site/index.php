<!--============LEFT PANE=================-->
<div class="leftpane">
	<div class="content filters">
		<h3>Filters</h3>
		<hr>
		<div class="categories">
			<div class="title">
				<i class="fa fa-th-list"></i> Categories
			</div>
			<div class="list">
				<?php foreach ($this->getCategories() as $value){ ?>
				<label>
					<input type="checkbox" value="<?php echo $value["category"];?>"/> <span><?php echo $value["category"];?></span>
				</label>
				<?php }?>
			</div>
		</div>
		<div class="types">
			<div class="title">
				<i class="fa fa-th-list"></i> Type
			</div>
			<div class="list">
				<?php foreach ($this->getTypes() as $value){ ?>
				<label>
					<input type="checkbox" value="<?php echo $value["type"];?>"/> <span><?php echo $value["type"];?></span>
				</label>
				<?php }?>
			</div>
		</div>
	</div>
</div>
<!--==============<<END OF LEFT PANE>>=============->


<!--=================<<RIGHT PANE>>================->
<!--Right pane is where the courses information is displayed with some
	controls related to sort.-->
<div class="rightpane">
	<div class="content table">
		<input type='text' id='searchbytext' placeholder="Search" style="margin-right : 10px;"/>
		<div id="searchstats" class="cell middle" style="width : 100%;">Search results</div>
		<span class="wordwrap middle cell" style="font-weight: 900;padding-right: 10px;">Sort By : </span>
		<a href="#" class="cell wordwrap sort asc" data-order="price">price <i class="fa fa-sort-numeric-asc"></i></a>
		<a href="#" class="cell wordwrap sort asc" data-order="category">category <i class="fa fa-sort-numeric-asc"></i></a>
		<a href="#" class="cell wordwrap sort asc" data-order="type">type <i class="fa fa-sort-numeric-asc"></i></a>
	</div>
	<div id="courses">
		<!-- List of courses are displayed here.-->
	</div>
</div>
<!--============<<END OF RIGHT PANE>>==============-->



<!--=============<<TEMPLATES>>=====================-->
<!--Templates are nothing but the code snippet of some components
These templates are themselves not useful, but are used by javascript on demand
.-->
<div class="templates" style="display : none;">
	<!--===========COURSE TEMPLATE==========-->
	<!--Course template is used by javascript when it needs to add a course to
	the list. It then clones this template and appends to the course list.-->
	<a href="" id="course_template" class="course table">
		<img src="" class="image cell"/>
		<div class="cell contents">
			<div class="table">
				<div class="title cell wordwrap"></div>
				<div class="type cell middle"></div>
			</div>
			<div class="description"></div>
			<div style="margin-top : 20px;">
				<div class="category"></div>
				<div style="float: right">
					<div class="cost wordwrap">
						<i class="fa fa-rupee"></i> <span class="value"></span>
					</div>
					<div class="rating wordwrap" style="color:green;">
						<i class="fa fa-star"></i>
					</div>
				</div>
				<div style="clear:both;"></div>
			</div>
		</div>
		<div class="cell info">
		</div>
	</a>
	<!--=======END OF COURSE TEMPLATE============-->
</div>
<!--==============<<END OF TEMPLATES>>===============-->