# Telegram Notes Bot

This is a simple Telegram bot that allows users to manage their notes and tasks directly through Telegram. The bot can add  and delete tasks, as well as display all tasks for a user.

## Getting Started

### Prerequisites

- PHP 7.4 or higher
- Composer
- MySQL or any other PDO-supported database

### Installation

1. **Clone the repository:**
    ```sh
    git clone https://github.com/yourusername/telegram-notes-bot.git
    cd telegram-notes-bot
    ```

2. **Install dependencies:**
    ```sh
    composer install
    ```

3. **Set up the database:**
    - Create a new database.
    - Run the following SQL commands to create the required tables:
    ```sql
    CREATE TABLE user (
        id INT AUTO_INCREMENT PRIMARY KEY,
        chatId BIGINT NOT NULL,
        status VARCHAR(255) NOT NULL
    );

    CREATE TABLE Notes (
        id INT AUTO_INCREMENT PRIMARY KEY,
        userId BIGINT NOT NULL,
        todo VARCHAR(255) NOT NULL,
        status TINYINT(1) NOT NULL DEFAULT 0
    );
    ```

4. **Configure the bot:**
    - Open the `sendMessage.php` file.
    - Replace the placeholder `YOUR_BOT_TOKEN_HERE` with your actual Telegram bot token.

### Usage

1. **Start the bot:**
    - Use the Telegram app to send commands to the bot.
    - The available commands are:
        - `/start` - Register the user and get a welcome message.
        - `/add` - Add a new task.
        - `/delete` - Delete a task.
        - `/tasks` - Get all tasks for the user.

2. **Examples:**
    - To add a task, send `/add` followed by the task description.
    - To delete a task, send `/delete` followed by the task ID.

### Files Description

- **sendMessage.php:** Handles sending messages and commands to the Telegram bot.
- **note.php:** Manages note operations such as adding, updating, and deleting notes.
- **routes.php:** Handles routing of tasks and user management.
- **user.php:** Manages user-related operations like registering users and updating statuses.

### Contributing

If you want to contribute to this project, please fork the repository and create a pull request with your changes.

### Acknowledgments

- [Telegram Bot API](https://core.telegram.org/bots/api)
- [Guzzle HTTP Client](https://github.com/guzzle/guzzle)

