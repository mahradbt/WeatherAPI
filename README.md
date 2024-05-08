# Weather App API with Authentication (Symfony, Docker)

This project provides a secure, RESTful backend API for a mobile weather application built with Symfony and Docker. Users can authenticate and access weather data and search functionalities through the API.


## Features

* Authentication: Implements a secure authentication system for user access control.
* RESTful API: Provides a well-defined API for weather data retrieval and search functions.
* Symfony Framework: Leverages the robust features and libraries of Symfony for backend development.
* Dockerized Environment: Ensures consistent and portable setup using Docker containers.


## Technologies

* Backend: Symfony
* Dockerization: Docker Compose
* Database: MariaDB
* Database Administration: phpMyAdmin (optional)
* Cache: Redis (optional)
* Webserver: Nginx
* PHP-fpm: v8.3


## Prerequisites

* Docker installed (https://docs.docker.com/engine/install/)
* Docker Compose installed (https://docs.docker.com/compose/install/)
* PHP and its dependencies installed (as required by your Symfony project)


## Installation

Clone this repository:

```bash
git clone https://github.com/mahradbt/weather-api.git
```

Navigate to the project directory:

```bash
cd weather-api
```

Copy the .env.example file to .env and configure environment variables:


```bash
cp .env.example .env
```


Update the .env file with your database credentials, API keys, and other necessary settings.
Build and start the Docker containers:


```bash
docker-compose up -d
```

The `-d` flag runs the containers in detached mode.


## Usage

Refer to the docs directory (if available) for detailed API documentation and usage instructions.
Implement user authentication and API calls in your mobile application according to the API specifications.
Configuration

Modify configuration files (e.g., config/packages/security.yaml) for authentication mechanisms and security policies.
Customize database settings (e.g., config/databases.yaml) if needed.
Contributing

Pull requests and suggestions are welcome! Please follow our contribution guidelines (if available) before submitting a pull request.
License

Specify the license under which your project is distributed (e.g., MIT, Apache).
Additional Notes

Consider including sections for troubleshooting, deployment instructions, and future development plans.
Use clear headings and formatting to enhance readability.
Leverage Markdown features (bold, italics, lists) for structure.
Provide links to relevant documentation for Symfony, Docker, and other technologies used.
By following these guidelines and tailoring them to your specific project, you can create an informative and helpful README.md file that effectively communicates the value and usage of your backend API.