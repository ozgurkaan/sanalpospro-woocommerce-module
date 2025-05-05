=== SanalPosPRO Payment Gateway ===
Contributors: eticsoftas
Donate link: [EticSoft Website](https://eticsoft.com)
Tags: woocommerce, payment gateway, credit card, installment, payment
Requires at least: 5.8
Tested up to: 6.8
Stable tag: 0.1.2
Requires PHP: 7.4
License: GPL-2.0-or-later
License URI: [GNU General Public License v2.0](https://www.gnu.org/licenses/gpl-2.0.html)

SanalPosPRO is a payment gateway integration plugin that provides secure and easy payment solution developed for WooCommerce.

== Description ==

SanalPosPRO payment gateway integration is designed as a comprehensive payment solution for e-commerce sites using WooCommerce. 
It provides a seamless payment experience through payment gateways with installment options and a modern interface.

Features:

* Easy integration
* Installment payment options
* Modern and classic themes
* Secure payment infrastructure
* Detailed reporting
* Responsive design

Supported Cards:

* Bonus Card
* Miles&Smiles
* World Card
* Maximum Card
* Axess Card
* CardFinans
* Paraf Card
* Advantage Card
* And many more...

== External Services ==

This plugin integrates with external services to provide a secure payment processing flow. 
Here is a comprehensive overview of all external services used:

= Payment Processing Services =

**1. Payment Processing API (api.paythor.com)**
* **PSP:** Payment Services Provider (authorized Bank/PF institutions)
* **Purpose:** Capturing payments of orders by using buyer credit/debit cards through PSP 
* **When Used:** During checkout process
* **Data Transmitted:**
  - Order information (amount, items, currency, cart)
  - Customer details (name, email, billing/shipping address) 
  - Card information (through secure bank iframe)
  - Transaction identifiers (Order ID, PSP process ID)
  - Merchant authentication data 
Terms of Service: [PayThor Terms of Service](https://cdn.paythor.com/spp-tos.md)
Privacy Policy: [PayThor Privacy Policy](https://cdn.paythor.com/spp-data-privacy-policy.md)

**2. Embedded Secure Payment Form (pay.paythor.com)**
* **Purpose:** Secure payment form handling embedded on the checkout page
* **When Used:** During checkout when customer enters payment details
* **Data Transmitted:**
  - Payment form data through a secure frame 
Terms of Service: https://cdn.paythor.com/spp-tos.md
Privacy Policy: https://cdn.paythor.com/spp-data-privacy-policy.md

= Resource Delivery Services =

**CDN Services (cdn.paythor.com)**
* **Purpose:** Retrieve dynamic options, available PSP gateways for the payment according to the given information of the order, and payment instrument  
* **When Used:** During the checkout process, interface loading, and payment gateway updates 
* **Resources Loaded:**
  - Images: Logos of card brands, program, network logos that appear on the payment form according to the credit card information 
  - Data Files: Payment options, configurations, QR code data, process meta data
  - Static Files: Payment gateway specific interface assets, privacy policies of 3rd party services of payment institutions, campaign information
* **Note:** Sensitive payment data is NOT transmitted through CDN. The CDN is used exclusively for static resources and configuration data to ensure a professional and up-to-date payment interface.

= Data Security and Privacy =

**Security Measures:**
* All external communications use secure HTTPS connections
* Sensitive payment data is processed directly through bank infrastructure
* Card data never passes through your website's servers
* Industry-standard SSL/TLS encryption for all data transmission
* Compliance with banking regulations and security standards
* Tokenization of payment information
* Minimal data collection policy - only necessary data is transmitted

**Terms and Policies:**
* Specific terms of service and privacy policies are governed by your bank's payment gateway agreement
* Documentation provided during merchant account setup
* All data handling complies with financial regulations and security standards

= Why We Need These Services =

1. **Secure Payment Processing:** To ensure secure and compliant payment handling
2. **Fraud Prevention:** To protect merchants and customers from fraudulent transactions
3. **Installment Processing:** To provide accurate installment calculations and payment options
4. **Transaction Verification:** To ensure reliable payment verification
5. **Resource Delivery:** To maintain up-to-date payment UI elements 
6. **Regulatory Compliance:** To meet banking and financial regulations

== Data Processing and Sharing Policy ==

SanalPosPRO Payment Gateway integrates with payment processing API(s) of authorized Banks and Payment Service Providers (PSP) to accomplish secure payment processing for your WooCommerce store. 
The following data can be shared with the Bank or the PSP according to the agreement between you and your Bank/PSP, and the payment process requirements of the service.

= What Data is Shared with PSPs/Banks =

1. **Transaction Data**
   * Order Information: Order ID, cart ID, currency
   * Cart Items: Product names, prices, quantities
   * Discount Information: Applied coupon codes and amounts
   * Shipping Information: Shipping costs and method

2. **Customer (buyer) Data (used for fraud protection)**
   * Basic Contact Information: Customer's first name, last name, email address, and phone number
   * Billing Address: Street address, city, state, postal code, and country
   * Shipping Address: Shipping recipient's name and address details
   * IP Address: Customer's IP address for fraud prevention and security

3. **Merchant/Entity Information**
   * Store Information: Store name, URL, store/admin email, phone, and address
   * Payment Settings: Currency and payment configuration, payment and refund policy

= When Data is Shared with a PSP/Bank/Partner =

Data can be shared at specific events in the payment process:

1. During Payment Initialization: When a customer proceeds to the checkout and selects this payment method
2. During Payment Processing: When the customer enters their payment details in the secure embedded form
3. During Payment Validation: After the payment is processed, to confirm the payment status
4. During Administrative Operations: When store administrators configure the payment gateway

= Why This Data Sharing is Necessary =

The sharing of this data with PSPs/Banks is essential for the following reasons:

1. **Secure Payment Processing:** Our payment processing partners adopt compatibility with international and industrial secure payment infrastructure standards
2. **Fraud Prevention and Protection:** Customer data helps detect and prevent fraudulent transactions
3. **Installment Options:** To provide installment payment options with appropriate plans and rates
4. **Transaction Verification:** Complete order details are necessary to verify and validate transactions
5. **Regulatory Compliance:** To meet regulatory requirements for financial transactions
6. **Customer Experience:** Enabling a seamless checkout experience with personalized payment options

== Installation ==

1. Upload the plugin to your WordPress plugin directory
2. Activate the plugin from WordPress admin panel
3. Configure SanalPosPRO from WooCommerce > Settings > Payments section
4. Create an account for the panel
5. Enter your username and password to log in, then add your PSP API credentials provided by your bank
6. Start accepting payments!

== Frequently Asked Questions ==

= How can I customize installment options? =

You can set installment options and commission rates from the plugin configuration page in your WordPress Admin panel.

= Can I change the installment theme? =

Yes, we offer two different theme options: modern and classic. You can select your preferred theme from Panel settings.

= Is the plugin compatible with block themes? =

Currently, our plugin does not support the block-based payment option view following WooCommerce's infrastructure update. This feature is in our development roadmap and will be implemented in an upcoming release. We are actively working on this enhancement to ensure full compatibility with modern WordPress block themes.

== Support ==

We offer support channels for your convenience:

* Ticket System: Create a support ticket at [Support Ticket System](https://support.eticsoft.com/submitticket.php?step=2&deptid=14)
* Email Support: For general inquiries, contact [info@eticsoft.com](mailto:info@eticsoft.com)

For detailed documentation and updates, visit our website: [EticSoft Website](https://eticsoft.com)

Plugin developer: EticSoft R&D Lab
Website: [EticSoft Website](https://eticsoft.com)