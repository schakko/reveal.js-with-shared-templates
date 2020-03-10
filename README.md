# Multiple presentations with a single reveal.js installation
## Current situation
I have been searching for a simple solution to made my presentations available in my WordPress based blog. The presentations themselve can be used for SEO purposes.
The existing [Slides & Presentations plug-in](https://wordpress.org/plugins/slide/) is cool but has a few drawbacks:

- There is no way to save the presentations outside of WordPress and develop them by hand. For a developer this is not a nice solution.
- The Gutenberg editor block for `Slides & Presentations` has a lot of bugs.
- You can't share templates between multiple presentations.

## Goals
- [x] Grunt is able to handle multiple presentations with a single reveal.js installation
- [x] A PHP script can map the required reveal.js assets
- [] The PHP script can be used to dynamically select a theme
- [] The PHP script shows available presentations from the `presentation` folder
- [] A WordPress plug-in exists to embed this prototype in it to make the presentations available in my blog

## Usage
First of all, run 

	git clone ${URL}
	npm install
	npm install -g grunt

### Developing reveal.js presentations locally

In the top-level directory execute

	grunt --root=presentation/demo/ serve

Inside the `gruntfile.js` there is an additional middleware to map the directories `css/`, `lib/` and `js/` to the `reveal.js` subfolder.

### Serving with a shared theme
My goal is to switch the theme or have a shared theme for all presentations. The `index.php` wraps the content of the reveal.js presentation into its own header/footer.
Make sure that your presentation contains the following structure:

	...
	<body>
		<!--reveal.js:BEGIN-->
		<div class="reveal">

		<!-- Presentation content follows ... -->

		</div>
		<!--reveal.js:END-->
		<script src="js/reveal.js"></script>

		<script>
	</body>
	...

Everything before and after the `reveal.js:BEGIN` and `reveal.js:END` marker is replaced with the PHP script's content.