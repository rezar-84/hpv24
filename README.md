# HPV24.com Project

Welcome to the official repository for [HPV24.com](https://hpv24.com), a comprehensive platform dedicated to providing support, consultation, and information for individuals affected by HPV (Human Papillomavirus) and related health conditions.

## Overview

HPV24.com is a project built upon **Drupal 10** using the **Varbase** distribution. The platform is designed to be user-friendly, secure, and scalable, ensuring that users can easily navigate through the resources available to them. Varbase enhances the Drupal experience by offering a powerful starter kit with numerous features and configurations that streamline development and ensure best practices.

### Features

- **Health Information:** Up-to-date articles and resources on HPV, its symptoms, treatments, and prevention methods.
- **Consultation Services:** Confidential and personalized consultation options for users seeking medical advice.
- **User-friendly Interface:** Built with a responsive design to ensure accessibility across all devices.
- **Privacy and Security:** Enhanced security features to protect user data and ensure confidentiality.
- **Varbase:** Utilizes the Varbase distribution, which accelerates development and provides a standardized configuration with a focus on the editor's experience.

### Varbase: The Ultimate Drupal CMS Starter Kit

Varbase is an enhanced Drupal distribution that includes a wide array of necessary modules, features, and configurations, making it an ideal choice for any Drupal project. It is designed with the following benefits in mind:

- **Speeds up development:** Pre-configured features and modules save time in setting up common functionalities.
- **Standardized configuration and best-practices:** Ensures that the site is built following best practices in the Drupal community.
- **Comprehensive functionalities:** Comes with a broad range of modules and features that are essential for everyday Drupal site development.
- **Thoroughly tested:** Varbase is extensively tested to ensure stability and reliability.

If you are starting a new project, consider using Varbase for Drupal 10. Installing Varbase 10.0.x includes additional automated installation steps that help you take full advantage of the distribution, beyond the standard Drupal 10 installation process.

## Built With

- **Drupal 10:** The latest version of Drupal, a powerful and flexible content management system.
- **Varbase:** A robust Drupal distribution that accelerates development and provides enhanced features.
- **PHP 8:** Used for server-side scripting to enhance the performance and security of the site.
- **MariaDB:** A reliable database solution for storing and managing user data.
- **Nginx:** A high-performance web server and reverse proxy used to serve the website.

## Getting Started

To get started with this project, you can clone the repository and set up your local environment. Make sure you have the following prerequisites:

### Prerequisites

- PHP 8 or higher
- Composer
- Drupal 10
- Varbase 10.x
- MariaDB
- Nginx or Apache

### Installation

1. Clone the repository:
    ```bash
    git clone https://github.com/your-username/hpv24.git
    cd hpv24
    ```

2. Install dependencies:
    ```bash
    composer install
    ```

3. Set up the environment variables and configure the `settings.php` file to connect to your database.

4. Run the Varbase installation:
    ```bash
    drush site:install --existing-config
    ```

5. Start your local server and visit `http://localhost` to view the site.

## Contributing

We welcome contributions to the HPV24.com project! If you would like to contribute, please follow these steps:

1. Fork the repository.
2. Create a new branch (`git checkout -b feature-branch`).
3. Make your changes.
4. Commit your changes (`git commit -m 'Add some feature'`).
5. Push to the branch (`git push origin feature-branch`).
6. Open a pull request.

## License

This project is licensed under the MIT License - see the [LICENSE](LICENSE) file for details.

## Contact

For more information, please visit [HPV24.com](https://hpv24.com) or reach out to us through our contact page.

