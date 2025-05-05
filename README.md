# 📧 Laravel Email Campaigns Package

This Laravel package provides a simple, API-first approach to create, filter, and send email campaigns to a customer base. Emails are sent asynchronously using queues, and delivery is tracked per recipient.

---

## 🚀 Features

- Import customers from SQL
- Create and manage email campaigns
- Filter customers by status and plan expiry
- Send email campaigns asynchronously via Laravel Queues
- Track delivery status (sent/failed)
- Built with APIs for seamless UI or external integration
- Supports **SendGrid** (or other Laravel-supported providers) //// Didnt used SendGrid due to API key as it took time....

---

## 📦 Installation

1. Install via Composer (within your Laravel project):

```bash
composer require codewithjak/email-campaigns
