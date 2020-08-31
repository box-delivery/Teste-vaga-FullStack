# FRONT-END

## Setting up a development environment

* create a file named .env (copy .env.example file) which should contain the following default setup ( you should provide your own values to this variables ):
```
VUE_APP_API_URL= 
```

## Scripts

**Install Modules**

* Run the "npm install" command on the terminal at the root of the front-end folder
```bash
npm install
```

## Run
* `npm run start` to start the app. 
* Visit [localhost:8080](http://localhost:8080) in your browser. 
* The `default port 8080` can be overwritten by updating the `package.json`, line with `start` attribute: `vue-cli-service serve --port 8080`