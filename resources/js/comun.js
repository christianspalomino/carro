
window.Vue = require('vue');


Vue.component('example-component', require('./components/ExampleComponent.vue').default);


if (document.getElementById('app')) {
	const app = new Vue({
		    el: '#app',//comienza en el id app
		});
}

if (document.getElementById('apicategoria')) {
	require('./admin/apicategoria');//requiero este archivo		
}

if (document.getElementById('apiproducto')) {
	require('./admin/apiproducto');//requiero este archivo		
}

if (document.getElementById('confirmareliminar')) {
	require('./confirmareliminar');
}

if (document.getElementById('api_search_autocomplete')) {
	require('./admin/api_search_autocomplete');//requiero este archivo		
}