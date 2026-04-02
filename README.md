# Taskflow API

## Installation

To install the Taskflow API, clone this repository and install the dependencies:

```bash
git clone https://github.com/guibndz/taskflow-api.git
cd taskflow-api
npm install
```

## Migration

To migrate the database, you will need to run the following command:

```bash
npx sequelize-cli db:migrate
```

Ensure that the database is configured correctly in the `.env` file:

```plaintext
database_url=<your_database_url>
```

## Testing

To run the tests, execute the following command:

```bash
npm test
```

Make sure to have the necessary test database set up in your environment.