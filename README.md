# Pinabacdao LGU WordPress Theme  
**Official Theme for the Municipality of Pinabacdao Website**  

## Overview  
A custom WordPress theme designed for the Municipality of Pinabacdao, Samar, Philippines. Built for transparency, accessibility, and efficient delivery of government services.  

### Key Features  
- Responsive, mobile-first design compliant with WCAG 2.1  
- Integrated components for government services (permits, FOI requests, BAC procurement)  
- Multilingual-ready (English/Filipino/Waray)  
- Optimized for performance on Philippine internet speeds  

## Requirements  
- WordPress 6.0+  
- PHP 8.0+  
- MySQL 5.7+  

## Installation  
1. Upload `pinabacdao-lgu-theme.zip` via WordPress Admin > Appearance > Themes  
2. Activate the theme  
3. Install required plugins (if prompted):  
   - Advanced Custom Fields PRO  
   - WPML (for multilingual support)  

## Development  
```bash
git clone https://github.com/IrishEgie/pinabacdao-lgu.git --branch theme
cd pinabacdao-lgu-theme
npm install
npm run dev
```

## File Structure  
```
theme/
├── assets/          # Compiled CSS/JS
├── inc/            # Theme functions
├── template-parts/ # Modular components
├── languages/      # Translation files
├── styles/         # SCSS source files
└── js/             # ES6 source scripts
```

## Contributing  
Submit pull requests to the `theme` branch. Follow:  
- [WordPress Coding Standards](https://developer.wordpress.org/coding-standards/)  
- Municipal design guidelines (see [CONTRIBUTING.md](../../../CONTRIBUTING.md))  

## License  
GPLv2 (inherits WordPress license) with additional terms:  
- Modifications must maintain government branding compliance  
- Commercial reuse requires municipal approval  

**Municipal ICT Office**  
ict@pinabacdao.gov.ph  

---

This version:  
1. Focuses on technical implementation  
2. Removes non-theme content (e.g., cultural/festival details)  
3. Highlights government-specific requirements  
4. Provides clear dev setup instructions  

Would you like to add:  
- A screenshot of the theme?  
- Plugin dependency details?  
- Municipal branding guidelines?
