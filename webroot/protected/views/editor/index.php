<?php
/* @var $this SiteController */
$this->pageTitle = Yii::app()->name;
Yii::app()->clientScript->registerCoreScript('jquery');
include 'style/default.css';
include 'style/editor.css';
include 'script/default.js';
?>
Editor
  <div id="wl_document" onMouseUp = "moveDividerOut()">
    <div id="wl_editor"> 
	<pre id="editor">\begin{page}
A kies honunkban leledzõ temérdek félelmetes bestia és szörny-állat között 
aligha akad csodásabb és halálosabb fajzat, mint a Baziliskus, más néven 
a Kígyók Királya. Ezen csúszómászó, mely gyakorta gigantikus méreteket ölt, 
száz-évekig is elélhetik. Bölcsõje a tyúknak tojása, melyen varangyos béka kotlik. 
Gyilkos fegyvere is felettébb csodásabb, hisz' halálos méregtõl csepegõ foga mellett 
a nézése is halált hozó: valamely ember vagy állat tekintetének tüzébe kerül, nyomban 
életét veszíti. A pókok menekülnek a Baziliskus elõl, mert emez gyûlölt ellenségük. 
A Baziliskus pediglen féli a kakasnak rikkantását, minek hallatán menten kiszenved. 
\end
</pre>

	<?php
		include 'script/editor.js';
	?>    
    </div>
    <div id="wl_divider" onMouseMove="moveDivider()" onmousedown="moveDividerClick()" onmouseup="moveDividerOut()"> </div>
    <div id="wl_preview"> 
        <img src="/images/bear.jpg" alt="bear" style="width:100%"/> 
    </div>
  </div>


