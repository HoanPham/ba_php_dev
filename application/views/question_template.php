<?php echo $_doctype; ?>
<html lang="en">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<?php echo $_meta; ?>
	<?php echo $_styles; ?>	
	<?php echo $_title; ?>			
</head>
<body>
	<div class="navbar navbar-inverse navbar-fixed-top">
		<div class="navbar-inner">
			<div class="container-fluid">
				<?php if(isset($navbar) && $navbar!=NULL) 
					echo $navbar;
				?>
			</div>
		</div>
	</div>	
	<div class="container-fluid">		
		<div class="row-fluid">
			<div class="span2">
				<?php if(isset($sidebar) && $sidebar!=NULL) 
					echo $sidebar;
				?>
			</div>
			<div class="span10">
				<div id="manage_questions" class="row-fluid show-grid box"> 
					<div id="list_question" class="span12" style="margin-left:10px;">
						<?php if(isset($manage_question) && $manage_question!=NULL) 
							echo $manage_question;
						?>
					</div>
    			</div>
    			<div id="create_question" class="row-fluid show-grid box" style="left:-75%;">
    				<div id="create_id_question" class="span12" style="margin-left:10px;">
    					<?php if(isset($tab_question_type) && $tab_question_type!=NULL) 
							echo $tab_question_type;
						?>
						<div id="myTabContent" class="tab-content">
							<div class="tab-pane fade active in" id="multiple_choice">
								<?php if(isset($tab_multichoice_question_type) && $tab_multichoice_question_type!=NULL) 
									echo $tab_multichoice_question_type;
								?>
								<div id="myTab_multiple_choiceContent" class="tab-content">
									<?php if(isset($multichoice_trad) && $multichoice_trad!=NULL) 
										echo $multichoice_trad;
									?>									
									<?php if(isset($multichoice_fullpoint) && $multichoice_fullpoint!=NULL) 
										echo $multichoice_fullpoint;
									?>
									<?php if(isset($multichoice_partpoint) && $multichoice_partpoint!=NULL) 
										echo $multichoice_partpoint;
									?>
								</div>								
							</div>
							<?php if(isset($short_answer) && $short_answer!=NULL) 
								echo $short_answer;
							?>
							<?php if(isset($cloze) && $cloze!=NULL) 
								echo $cloze;
							?>
						</div>
    				</div>
    			</div> 			
    		</div>
		</div>
	</div>
	<div style="clear:both;"></div>
	<footer id="footer">
		<div class="footer-container">
			<div class="row-fluid main-links">
				<div class="span2">
					<ul>
						<li class="heading footer-scroll-cue">About</li>
						<li><a href="/about">Our Mission</a>
						</li>
						<li><a href="/about/blog">Blog</a>
						</li>
						<li><a href="/about/the-team">Our Team</a>
						</li>
						<li><a href="/about/our-interns">Our Interns</a>
						</li>
						<li><a href="/about/our-content-specialists">Our Content
								Specialists</a>
						</li>
						<li><a href="/about/our-supporters">Our Supporters</a>
						</li>					
					</ul>
				</div>
				<div class="span2">
					<ul>
						<li class="heading footer-scroll-cue">Help</li>
						<li><a href="/reportissue?type=Defect&amp;issue_labels="
							data-tag="Footer" id="report" class="show-demo-dialog">Report
								a Problem</a>
						</li>
						<li><a href="http://khanacademy.desk.com/">FAQ</a>
						</li>
					</ul>
				</div>
				<div class="span2">
					<ul>
						<li class="heading footer-scroll-cue">Contact Us</li>
						<li><a href="http://khanacademy.desk.com/">Contact</a>
						</li>
						<li><a
							href="http://khanacademy.desk.com/customer/portal/articles/441307-press-room">Press</a>
						</li>
					</ul>
				</div>
				<div class="span2">
					<ul>
						<li class="heading footer-scroll-cue">Coaching</li>
						<li><a href="/class_profile">Coach Dashboard</a>
						</li>
						<li><a href="/coach-res">Coach Resources</a>
						</li>
						<li><a href="/coach-res/case-studies">Case Studies</a>
						</li>
						<li><a href="/commoncore">Common Core</a>
						</li>
					</ul>
				</div>
				<div class="span2">
					<ul>
						<li class="heading footer-scroll-cue">More</li>
						<li><a href="/donate">Donate</a>
						</li>
						<li><a href="/contribute">Contribute</a>
						</li>
						<li><a href="http://shop.khanacademy.org/">Shop KA</a>
						</li>
					</ul>
				</div>
				
				<!-- 
				<div class="span1">
					<img class="handtree"
						src="https://khan-academy.appspot.com/images/khan-logo-vertical-transparent.png">
				</div>
				-->
			</div>
			<div class="extra-links clearfix">
				<div class="legal">
					<span><a href="/about/tos">Terms of Use</a>
					</span>
				</div>
				<div class="legal">
					<span><a href="/about/privacy-policy">Privacy Policy</a>
					</span>
				</div>

				<div class="copyright"
					title="Version: 0822-d9e68d89657f.369699905479567331">
					© 2013 Konocy - Bill Academy <br> Except where noted, all rights
					reserved.
				</div>
			</div>
		</div>
	</footer>
	<script src="http://cdn.mathjax.org/mathjax/latest/MathJax.js?config=TeX-AMS_HTML.js"></script>
	<?php echo $_scripts; ?>				
</body>
</html>