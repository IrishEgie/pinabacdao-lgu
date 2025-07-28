/**
 * Updated index.js with Search module integration
 */

import { TabNavigation } from './modules/TabNav';
import { HeaderNavigation } from './modules/HeaderNav';
import { ContactForm } from './modules/ContactForm';
import { Accordion } from './modules/Accordion';
import Search from './modules/Search.js';

document.addEventListener('DOMContentLoaded', () => {

    // Initialize all tab navigations on the page
    document.querySelectorAll('[data-tab-navigation]').forEach(container => {
        new TabNavigation(container);
    });

    // Initialize header navigation
    const header = document.querySelector('header');
    if (header) {
        new HeaderNavigation(header);
    }

    // Initialize contact forms
    document.querySelectorAll('#contact-form').forEach(form => {
        new ContactForm(form);
    });

    // Initialize accordions with verification
    const accordionContainers = document.querySelectorAll('.divide-y.divide-gray-200');
    console.log(`Found ${accordionContainers.length} accordion containers`);
    
    accordionContainers.forEach(container => {
        new Accordion(container);
    });

    // Initialize Search functionality
    new Search();
    
});