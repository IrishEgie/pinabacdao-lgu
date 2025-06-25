# Contributing Guidelines
## Municipality of Pinabacdao Official Website

Thank you for your interest in contributing to the official website of the Municipality of Pinabacdao! This document provides comprehensive guidelines for contributing to our digital government platform.

---

## Important Legal Notice

**BEFORE CONTRIBUTING**: All contributions to this government website must comply with Philippine laws, municipal regulations, and official policies. By contributing, you acknowledge that your submissions may be subject to:

- **Freedom of Information Act** requirements
- **Data Privacy Act** compliance
- **Government audit** and review processes
- **Public records** retention policies

---

## Prerequisites

### **Required Reading**
- [Code of Conduct](CODE_OF_CONDUCT.md)
- [Security Policy](SECURITY.md)
- [License Agreement](LICENSE.md)
- [Data Privacy Notice](PRIVACY.md)

### **Legal Requirements**
- Must be 18+ years old or have parental consent
- Agree to background verification if required
- Consent to contribution audit and review
- Understand public nature of government repositories

---

## Types of Contributions

### **1. Bug Reports**
Help us identify and fix technical issues.

**Before Reporting:**
- Search existing issues to avoid duplicates
- Test on multiple browsers/devices
- Check if issue affects government services

**Security Issues**: Report privately to `ict@pinabacdao.gov.ph`

### **2. Feature Requests**
Suggest improvements for municipal services.

**Requirements:**
- Must serve public interest
- Align with municipal priorities
- Consider resource constraints
- Ensure legal compliance

### **3. Translation Contributions**
Help make the website multilingual.

**Supported Languages:**
- **English** (Primary)
- **Filipino** (National)
- **Waray-Waray** (Local - Priority)

**Translation Standards:**
- Use official government terminology
- Maintain cultural sensitivity
- Ensure accuracy of municipal information

### **4. Content Contributions**
Improve information accuracy and completeness.

**Acceptable Content:**
- ✅ Historical facts and documentation
- ✅ Cultural information and local traditions
- ✅ Service descriptions and procedures
- ✅ Educational content about local government

**Requires Official Verification:**
- Government policies and procedures
- Contact information and office hours
- Legal requirements and regulations
- Municipal statistics and data

### **5. Design & UX Improvements**
Enhance user experience and accessibility.

**Priorities:**
- Mobile-first responsive design
- WCAG 2.1 AA accessibility compliance
- Government branding consistency
- Multi-language support
- Senior citizen and PWD accessibility

### **6. Technical Improvements**
Code quality, performance, and security enhancements.

**Focus Areas:**
- WordPress theme optimization
- Database query optimization
- Security hardening
- Performance improvements
- SEO enhancement

---

## Getting Started

### **1. Development Environment Setup**

```bash
# Fork the repository
git clone https://github.com/IrishEgie/pinabacdao-lgu.git

# Navigate to theme directory
cd wp-content/themes/pinabacdao-lgu

# Install dependencies
npm install

# Start development server
npm run dev
```

### **2. WordPress Setup**
```bash
# Local development requirements
- PHP 8.0+
- MySQL 5.7+ / MariaDB 10.3+
- WordPress 6.0+
- Node.js 18+

# Recommended tools
- Local by Flywheel
- XAMPP/WAMP
- Docker with WordPress
```

---

## Development Standards

### **Code Quality**
```php
// PHP Standards
- Follow WordPress Coding Standards
- Use proper sanitization and validation
- Implement proper error handling
- Add inline documentation
```

```css
/* CSS Standards */
- Use Tailwind CSS utility classes
- Follow BEM methodology for custom CSS
- Ensure responsive design
- Test on multiple devices
```

```javascript
// JavaScript Standards
- Use modern ES6+ syntax
- Implement proper error handling
- Follow WordPress JavaScript standards
- Ensure accessibility compliance
```

### **File Structure**
```
wp-content/themes/pinabacdao-lgu/
├── assets/
│   ├── css/
│   ├── js/
│   └── images/
├── inc/
│   ├── government/
│   ├── services/
│   └── security/
├── templates/
│   ├── government/
│   ├── news/
│   └── services/
└── languages/
    ├── en_US/
    ├── fil_PH/
    └── war_PH/
```

---

## Security Requirements

### **Mandatory Security Practices**
- **Input Validation**: Sanitize all user inputs
- **Output Escaping**: Escape all outputs
- **Nonce Verification**: Use WordPress nonces for forms
- **Capability Checks**: Verify user permissions
- **SQL Injection Prevention**: Use prepared statements

### **WordPress Security**
```php
// Example: Secure form handling
if (isset($_POST['submit']) && wp_verify_nonce($_POST['_wpnonce'], 'municipal_form')) {
    $input = sanitize_text_field($_POST['user_input']);
    // Process securely...
}
```

### **Prohibited Practices**
- ❌ Direct database queries without preparation
- ❌ Unescaped output to HTML
- ❌ Hardcoded credentials or API keys
- ❌ File uploads without validation
- ❌ Execution of user-provided code

---

## Accessibility Standards

### **WCAG 2.1 AA Compliance**
- **Perceivable**: Alt text, proper contrast ratios
- **Operable**: Keyboard navigation, no seizure triggers
- **Understandable**: Clear language, consistent navigation
- **Robust**: Valid HTML, screen reader compatibility

### **Testing Requirements**
```bash
# Accessibility testing tools
- WAVE Web Accessibility Evaluator
- axe DevTools
- Lighthouse accessibility audit
- Screen reader testing (NVDA/JAWS)
```

---

## Content Guidelines

### **Writing Standards**
- **Plain Language**: Use simple, clear language
- **Government Style**: Follow Philippine government writing standards
- **Inclusive Language**: Avoid discriminatory or exclusive terms
- **Cultural Sensitivity**: Respect local customs and traditions

### **Information Accuracy**
- **Fact Checking**: Verify all municipal information
- **Source Attribution**: Credit official sources
- **Update Frequency**: Keep information current
- **Legal Review**: Have legal content reviewed by Municipal Legal Office

---

## Review Process

### **1. Initial Review**
```bash
# Self-checklist before submission
- [ ] Code follows WordPress standards
- [ ] Security best practices implemented
- [ ] Accessibility requirements met
- [ ] No sensitive information exposed
- [ ] Proper documentation included
```

### **2. Technical Review**
- **Automated Tests**: Security scans, code quality checks
- **Manual Testing**: Functionality, cross-browser compatibility
- **Performance Review**: Page speed, database optimization
- **Security Audit**: Vulnerability assessment

### **3. Content Review**
- **Municipal IT Office**: Technical accuracy
- **Legal Office**: Legal compliance
- **Public Information Office**: Content appropriateness
- **Mayor's Office**: Final approval for major changes

### **4. Approval Timeline**
- **Minor Changes**: 3-5 business days
- **Major Features**: 1-2 weeks
- **Security Updates**: Expedited (24-48 hours)
- **Content Updates**: Varies based on verification needs

---

## Submission Process

### **Step 1: Preparation**
```bash
# Create feature branch
git checkout -b feature/description-of-change

# Make your changes
# Test thoroughly
# Document changes
```

### **Step 2: Documentation**
## Pull Request Template
- **Type**: Bug fix / Feature / Content update
- **Description**: Clear description of changes
- **Testing**: How changes were tested
- **Screenshots**: For UI changes
- **Legal Compliance**: Confirmation of compliance


### **Step 3: Submission**
1. **Push Changes**: Push to your forked repository
2. **Create Pull Request**: Submit via GitHub interface
3. **Complete Templates**: Fill all required information
4. **Request Review**: Tag appropriate reviewers

---

## Common Rejection Reasons

### **Technical Issues**
- Fails security standards
- Breaks existing functionality
- Poor code quality or documentation
- Accessibility violations

### **Content Issues**
- Unverified municipal information
- Political or partisan content
- Cultural insensitivity
- Legal compliance concerns

### **Process Issues**
- Incomplete documentation
- Missing required approvals
- Violation of contribution guidelines
- Failure to follow review feedback

---

## Priority Areas

### **High Priority**
1. **Security Improvements**: Vulnerability fixes, security hardening
2. **Accessibility**: WCAG compliance, senior citizen accessibility
3. **Mobile Optimization**: Responsive design improvements
4. **Waray Translation**: Local language support

### **Medium Priority**
1. **Performance**: Page speed optimization
2. **SEO**: Search engine optimization
3. **User Experience**: Navigation and usability improvements
4. **Content Management**: CMS improvements for staff

### **Low Priority**
1. **Visual Enhancements**: Non-critical design improvements
2. **Advanced Features**: Complex functionality additions
3. **Integration**: Third-party service integration

---

## Getting Help

### **Technical Support**
- **Email**: `developer@pinabacdao.gov.ph`
- **Issues**: Create GitHub issue with `question` label
- **Documentation**: Check `/docs` folder

### **Content Questions**
- **Public Information Office**: `pio@pinabacdao.gov.ph`
- **Municipal Services**: Contact relevant department

### **Legal/Compliance**
- **Legal Office**: `legal@pinabacdao.gov.ph`
- **Data Privacy**: `dpo@pinabacdao.gov.ph`

---

## Recognition

### **Contributor Recognition**
- **Municipal Website Credits**: Listed on contributors page
- **Annual Recognition**: Municipal appreciation program
- **Certificate of Appreciation**: For significant contributions
- **Community Impact**: Recognition of public service

### **Contributor Levels**
- **Community Member**: Occasional contributions
- **Regular Contributor**: Monthly contributions
- **Core Contributor**: Significant ongoing contributions
- **Maintainer**: Trusted community leaders

---

## Resources

### **Development Resources**
- [WordPress Developer Handbook](https://developer.wordpress.org/)
- [Tailwind CSS Documentation](https://tailwindcss.com/docs)
- [WCAG 2.1 Guidelines](https://www.w3.org/WAI/WCAG21/quickref/)

### **Government Resources**
- [Philippine Digital Government Guidelines](https://dict.gov.ph)
- [Data Privacy Act Implementation](https://privacy.gov.ph)
- [Local Government Code](https://lawphil.net/statutes/repacts/ra1991/ra_7160_1991.html)

### **Municipal Resources**
- [Municipal Organizational Chart](ORGANIZATIONAL_CHART.md)
- [Service Delivery Standards](SERVICE_STANDARDS.md)
- [Emergency Contact Procedures](EMERGENCY_CONTACTS.md)

---

## Legal Disclaimer

By contributing to this repository, you:

1. **Grant License**: Allow the Municipality of Pinabacdao to use your contributions
2. **Warrant Ownership**: Confirm you own or have rights to contributed content
3. **Accept Review**: Agree to municipal review and potential modification
4. **Understand Public Nature**: Acknowledge contributions become public record

---

**Questions?** Contact us at `webmaster@pinabacdao.gov.ph`

**Last Updated**: June 2025  
**Review Schedule**: Quarterly review by Municipal IT Office

---

*These guidelines ensure our website serves the public interest while maintaining the highest standards of security, accessibility, and legal compliance.*