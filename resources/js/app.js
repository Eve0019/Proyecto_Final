import './bootstrap';
import 'flowbite';

import Pikaday from 'pikaday';
import Alpine from 'alpinejs';
import focus from '@alpinejs/focus';
import collapse from '@alpinejs/collapse'

window.Alpine = Alpine;
window.Pikaday = Pikaday


Alpine.plugin(focus);
Alpine.plugin(collapse);

Alpine.start();
