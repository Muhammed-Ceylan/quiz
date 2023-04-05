import './bootstrap';
import jquery from 'jquery';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
window.Alpine = Alpine;

Alpine.plugin(focus);

Alpine.start();

window.jQuery = jquery;
window.jquery = jquery;