
<div id="stage"></div>

<script>
	width = 300;
	height = 200;
	
	var scene = new THREE.Scene();
	var camera = new THREE.PerspectiveCamera( 75, width / height, 0.1, 1000 );

	var renderer = new THREE.WebGLRenderer();
	renderer.setSize( width, height );
	renderer.setClearColor( 0xffffff );
	document.getElementById("stage").appendChild( renderer.domElement );	 

	var geometry = new THREE.BoxGeometry( 1, 1, 1 );
	var material = new THREE.MeshPhongMaterial( { 
		color: 0xcccc00, 
		specular: 0x009900, 
		shininess: 30, 
		shading: THREE.FlatShading	
	} );
	var cube = new THREE.Mesh( geometry, material );
	scene.add( cube );
	
	var directionalLight = new THREE.DirectionalLight( 0xffffff, 1 );
	directionalLight.position.set( 0, 1, 0 );
	scene.add( directionalLight );
		
	var light = new THREE.AmbientLight( 0x404040 ); // soft white light
	scene.add( light );
	
	camera.position.z = 20;

	controls = new THREE.OrbitControls( camera );
	controls.damping = 0.2;
	controls.addEventListener( 'change', render );

	
	var manager = new THREE.LoadingManager();
	manager.onProgress = function ( item, loaded, total ) {
		console.log( item, loaded, total );
	};
	var onProgress = function ( xhr ) {
		if ( xhr.lengthComputable ) {
			var percentComplete = xhr.loaded / xhr.total * 100;
			console.log( Math.round(percentComplete, 2) + '% downloaded' );
		}
	};
	var onError = function ( xhr ) {
	};
	var texture = new THREE.Texture();
	var loader = new THREE.OBJLoader( manager );
	loader.load( 
		'<?php echo plugins_url('models/ferrari/ferrari-f1-race-car.obj', __FILE__) ?>', 
		function ( object ) {
			object.traverse( function ( child ) {
				if ( child instanceof THREE.Mesh ) {
					child.material.color.setHex( 0xffaa66 );
				}
			} 
		);
		object.position.z = - 100;
		scene.add( object );
	}, onProgress, onError );

	
	function render() {
		requestAnimationFrame( render );

		renderer.render( scene, camera );
	}
	render();		
</script>

