<div class="sidebar" data-color="white" data-active-color="danger">
	<!--
	Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red | yellow"
	-->
	<div class="logo">
		<a href="{{route('home')}}" target="_blank" class="simple-text logo-mini">
			<div class="logo-image-small">
				<i class="ion-ios-world-outline" style="font-size:2rem"></i>
			</div>
		</a>
		<a href="{{route('home')}}" target="_blank" class="simple-text logo-normal">
				{{env('APP_NAME')}}
			<!-- <div class="logo-image-big">
			<img src="../assets/img/logo-big.png">
			</div> -->
		</a>
	</div>

	<div class="sidebar-wrapper">
		<ul class="nav">
			<li class="active ">
			<a href="{{route('dashboard.home')}}">
				<i class="ion-clipboard lead"></i>
				<p>Dashboard</p>
			</a>
			</li>
			<li>
			<a href="{{route('posts.index')}}">
				<i class="ion-paper-airplane lead"></i>
				<p>Post</p>
			</a>
			</li>
			<li>
			<a href="{{route('posts.index')}}">
				<i class="ion-briefcase lead"></i>
				<p>Project</p>
			</a>
			</li>
			<li>
			<a href="./map.html">
				<i class="lead ion-ios-chatboxes-outline"></i>
				<p>Comments</p>
			</a>
			</li>
			<li>
			<a href="./notifications.html">
				<i class="lead ion-android-notifications-none"></i>
				<p>Notifications</p>
			</a>
			</li>
			<li>
			<a href="{{route('about.user',auth()->id())}}">
				<i class="ion-person lead"></i>
				<p>User Profile</p>
			</a>
			</li>
			<li>
			<a href="./tables.html">
				<i class="ion-aperture lead"></i>
				<p>Pictures</p>
			</a>
			</li>

		</ul>
	</div>
</div>