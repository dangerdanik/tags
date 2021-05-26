
<?php foreach ($comments as $comment): ?>
	<div class="one-comment-block">
		<div class="photo-comment">
			<div class="image-overlay">
				<img src="/novo/img/man.jpg" alt="">
			</div>
		</div>
		<div class="content-comment">
			<div class="content-comment-head">
				<span class="name"><?= $comment->username ?></span>
				<span class="data"><?= date("d M, Y, в H:m", $comment->created_at) ?></span>
				<a href="#comment-text" onclick="reply(<?= $comment->id ?>, '<?= $comment->username ?>')">Ответить</a>
			</div>
			<div class="content-comment-content">
				<p><?= $comment->text ?></p>
			</div>
		</div>
	</div>
	<?php if ($comment->reply): ?>
		<?php 
			$countReply = sizeof($comment->reply);
			$replyes = $comment->reply;
			$firstReply = array_shift($replyes);
		?>
		<div class="accordion-container">
			<div class="set">
				<div class="show-all-comments">	
					<span class="anser">Ответы</span>
					<div class="border">
						<div class="border-in"></div>
					</div>
					<?php if ($countReply > 1): ?>
						<a href="#" class="show-list-all show-list no-init-show-list"><span>Показать все <?= $countReply ?></span><span class="ico ico-drop-green"></span></a>
					<?php endif ?>
				</div>
				<div class="clr"></div>
				<div class="accordion-content">
					<?php foreach ($replyes as $reply): ?>
						<div class="one-comment-block sub-comment">
							<div class="photo-comment">
								<div class="image-overlay">
									<img src="/novo/img/man.jpg" alt="">
								</div>
							</div>
							<div class="content-comment">
								<div class="content-comment-head">
									<span class="name"><?= $reply->username ?></span>
									<span class="data"><?= date("d M, Y, в H:m", $comment->created_at) ?></span>
									<!-- <a href="#">Ответить</a> -->
								</div>
								<div class="link-for">
									<span class="ico icon-back"></span>
									<span><?= $comment->username ?></span>
								</div>
								<div class="content-comment-content">
									<p><?= $reply->text ?></p>
								</div>
							</div>
						</div>
					<?php endforeach ?>
				</div>
			</div>
		</div>
		<div class="one-comment-block sub-comment">
			<div class="photo-comment">
				<div class="image-overlay">
					<img src="/novo/img/man.jpg" alt="">
				</div>
			</div>
			<div class="content-comment">
				<div class="content-comment-head">
					<span class="name"><?= $firstReply->username ?></span>
					<span class="data"><?= date("d M, Y, в H:m", $firstReply->created_at) ?></span>
					<!-- <a href="#">Ответить</a> -->
				</div>
				<div class="link-for">
					<span class="ico icon-back"></span>
					<span><?= $comment->username ?></span>
				</div>
				<div class="content-comment-content">
					<p><?= $firstReply->text ?></p>
				</div>
			</div>
		</div>
		<div class="clr"></div>
	<?php endif ?>
<?php endforeach ?>

<?php /*
<div class="one-comment-block">
	<div class="photo-comment">
		<div class="image-overlay">
			<img src="/novo/img/man.jpg" alt="">
		</div>
	</div>
	<div class="content-comment">
		<div class="content-comment-head">
			<span class="name">Жевачкин Сергей</span>
			<span class="data">23 Июля, 2015, в 13:30</span>
			<a href="#">Ответить</a>
		</div>
		<div class="content-comment-content">
			<p>Задача организации, в особенности же постоянный количественный рост и сфера нашей активности позволяет оценить значение систем массового участия. Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение нашей деятельности представляет собой интересный эксперимент проверки позиций, занимаемых участниками в отношении поставленных задач.</p>
		</div>
	</div>
</div>
<div class="accordion-container">
	<div class="set">
		<div class="show-all-comments">	
			<span class="anser">Ответы</span>
			<div class="border">
				<div class="border-in"></div>
			</div>
			<a href="#" class="show-list-all"><span>Показать все 20</span><span class="ico ico-drop-green"></span></a>
		</div>
		<div class="clr"></div>
		<div class="accordion-content">
			<div class="one-comment-block sub-comment">
				<div class="photo-comment">
					<div class="image-overlay">
						<img src="/novo/img/man.jpg" alt="">
					</div>
				</div>
				<div class="content-comment">
					<div class="content-comment-head">
						<span class="name">Кондратьев Валентин</span>
						<span class="data">23 Июля, 2015, в 13:30</span>
						<a href="#">Ответить</a>
					</div>
					<div class="link-for">
						<span class="ico icon-back"></span>
						<span>Жвачкину сергею</span>
					</div>
					<div class="content-comment-content">
						<p>Задача организации, в особенности же постоянный количественный рост и сфера нашей активности позволяет оценить значение систем массового участия. Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение нашей деятельности представляет собой интересный эксперимент проверки позиций, занимаемых участниками в отношении поставленных задач.</p>
					</div>
				</div>
			</div>
			<div class="one-comment-block sub-comment">
				<div class="photo-comment">
					<div class="image-overlay">
						<img src="/novo/img/man.jpg" alt="">
					</div>
				</div>
				<div class="content-comment">
					<div class="content-comment-head">
						<span class="name">Кондратьев Валентин</span>
						<span class="data">23 Июля, 2015, в 13:30</span>
						<a href="#">Ответить</a>
					</div>
					<div class="link-for">
						<span class="ico icon-back"></span>
						<span>Жвачкину сергею</span>
					</div>
					<div class="content-comment-content">
						<p>Задача организации, в особенности же постоянный количественный рост и сфера нашей активности позволяет оценить значение систем массового участия. Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение нашей деятельности представляет собой интересный эксперимент проверки позиций, занимаемых участниками в отношении поставленных задач.</p>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="one-comment-block sub-comment">
	<div class="photo-comment">
		<div class="image-overlay">
			<img src="/novo/img/man.jpg" alt="">
		</div>
	</div>
	<div class="content-comment">
		<div class="content-comment-head">
			<span class="name">Кондратьев Валентин</span>
			<span class="data">23 Июля, 2015, в 13:30</span>
			<a href="#">Ответить</a>
		</div>
		<div class="link-for">
			<span class="ico icon-back"></span>
			<span>Жвачкину сергею</span>
		</div>
		<div class="content-comment-content">
			<p>Задача организации, в особенности же постоянный количественный рост и сфера нашей активности позволяет оценить значение систем массового участия. Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение нашей деятельности представляет собой интересный эксперимент проверки позиций, занимаемых участниками в отношении поставленных задач.</p>
		</div>
	</div>
</div>
<div class="clr"></div>
<div class="comment-border"></div>
<div class="one-comment-block">
	<div class="photo-comment">
		<div class="image-overlay">
			<img src="/novo/img/man.jpg" alt="">
		</div>
	</div>
	<div class="content-comment">
		<div class="content-comment-head">
			<span class="name">Жевачкин Сергей</span>
			<span class="data">23 Июля, 2015, в 13:30</span>
			<a href="#">Ответить</a>
		</div>
		<div class="content-comment-content">
			<p>Задача организации, в особенности же постоянный количественный рост и сфера нашей активности позволяет оценить значение систем массового участия. Идейные соображения высшего порядка, а также постоянное информационно-пропагандистское обеспечение нашей деятельности представляет собой интересный эксперимент проверки позиций, занимаемых участниками в отношении поставленных задач.</p>
		</div>
	</div>
</div>
<div class="comment-border"></div>
*/ ?>