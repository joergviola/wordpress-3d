
<div id="stage"></div>

<script>
    stage = document.getElementById("stage");  

	width = 800;
	height = 400;
	
	var scene = new THREE.Scene();
	var camera = new THREE.PerspectiveCamera( 75, width / height, 0.1, 100000 );

	var renderer = new THREE.WebGLRenderer();
	renderer.setSize( width, height );
	renderer.setClearColor( 0x<?php echo $background ?>);
	stage.appendChild( renderer.domElement );	 

	var geometry = new THREE.BoxGeometry( 1, 1, 1 );
	var material = new THREE.MeshPhongMaterial( { 
		color: 0xcccc00, 
		specular: 0x009900, 
		shininess: 30, 
		shading: THREE.FlatShading	
	} );
	var cube = new THREE.Mesh( geometry, material );
	//scene.add( cube );
	
	var directionalLight = new THREE.DirectionalLight( 0xffffff, 1 );
	directionalLight.position.set( 0, 1, 1 );
	scene.add( directionalLight );
		
	var light = new THREE.AmbientLight( 0x404040 ); // soft white light
	scene.add( light );
	
	camera.position.x = 50;
	camera.position.y = 50;
	camera.position.z = 30;
	
	controls = new THREE.OrbitControls( camera, stage );
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
		alert("Fehler");
	};
	var texture = new THREE.Texture();
	  var loader = new THREE.ColladaLoader();
	  loader.options.convertUpAxis = true;
	  loader.load('<?php echo $model ?>', function ( collada ) {
	  var dae = collada.scene;
	  var skin = collada.skins[ 0 ];
	  dae.position.set(0,9,0);//x,z,y- if you think in blender dimensions ;)
	  dae.scale.set(1.5,1.5,1.5);

	  scene.add(dae);
	});



	
	
	function render() {
		requestAnimationFrame( render );

		renderer.render( scene, camera );
	}
	render();		
</script>

