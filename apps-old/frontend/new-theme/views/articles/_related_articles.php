	<aside>
    <span class="white-aside">
      <h4>Related Articles</h4>
    </span>

    <span class="grey-aside" id="related">
  <section class="related-articles">
    <ul>
		<?php
		foreach($latest as $k=>$v){
			echo '<li><a href="'.Yii::app()->createUrl('articles/view',array('slug'=>$v->slug)).'">'.$v->title.'</a> </li>';
		}
        ?>
      
    </ul>
  </section>

</span>
    
      
     
    <style>
    aside {
    border-radius: 3px;
    border: 1px solid #CCCCCC;
    float: right;
    margin-top: 20px;
    width: 290px;
    background: #fff;
}
.white-aside::after {
    bottom: -30px;
    border: solid transparent;
    content: " ";
    height: 0;
    width: 0;
    position: absolute;
    pointer-events: none;
    border-color: rgba(255, 255, 255, 0);
    border-top-color: #ffffff;
    border-width: 15px;
    left: 128px;
}
.grey-aside {
    background: #f3f3f3;
    float: left;
    padding: 35px 25px 20px;
    text-align: center;
    width: 100%;
}
.white-aside h4 {
    font-size: 18px;
    margin: 0;
}
.white-aside {
    float: left;
    padding: 20px;
    text-align: center;
    position: relative;
    width: 100%;
    background: #fff;
}
aside  ul {
    text-align: left;
}
    </style>
  </aside>
	
