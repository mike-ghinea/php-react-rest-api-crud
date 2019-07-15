<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>PHP| MySQL | React.js | Axios Example</title>
    <script src="https://unpkg.com/react@16/umd/react.production.min.js"></script>
    <script src="https://unpkg.com/react-dom@16/umd/react-dom.production.min.js"></script>
    <!-- Load Babel Compiler -->
    <script src="https://unpkg.com/babel-standalone@6.15.0/babel.min.js"></script>

    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>

</head>

<body>
    <div id='root'></div>

    <script type="text/babel">

        class ContactForm extends React.Component {
        state = {
            name: '',
            email: '',
            contact: '',
            city: '',
        }

    handleFormSubmit( event ) {
        event.preventDefault();


        let formData = new FormData();
        formData.append('name', this.state.name)
        formData.append('email', this.state.email)
        formData.append('city', this.state.city)
        formData.append('country', this.state.contact)

        console.log("Trying to contact the API...");

        axios({
            method: 'post',
            url: '/api/contacts.php',
            data: formData,
            config: { headers: {'Content-Type': 'multipart/form-data' }}
        })
        .then(function (response) {
            //handle success
            console.log(response)

        })
        .catch(function (response) {
            //handle error
            console.log(response)
        });
    }

    render(){
        return (
        <form>
            <label>Name</label>
            <input type="text" name="name" value={this.state.name}
                onChange={e => this.setState({ name: e.target.value })}/>

            <label>Email</label>
            <input type="email" name="email" value={this.state.email}
                onChange={e => this.setState({ email: e.target.value })}/>

            <label>Contact</label>
            <input type="text" name="contact" value={this.state.contact}
                onChange={e => this.setState({ country: e.target.value })}/>

            <label>City</label>
            <input type="text" name="city" value={this.state.city}
                onChange={e => this.setState({ city: e.target.value })}/>

            <input type="submit" onClick={e => this.handleFormSubmit(e)} value="Create Contact" />
        </form>);
    }
}

class App extends React.Component {
  state = {
    contacts: []
  }
  render() {
    return (
        <React.Fragment>
        <h1>Contact Management</h1>
        <table border='1' width='100%' >
        <tr>
            <th>Name</th>
            <th>Email</th>
            <th>Contact</th>
            <th>City</th>  
        </tr>

        {this.state.contacts.map((contact) => (
        <tr>
            <td>{ contact.name }</td>
            <td>{ contact.email }</td>
            <td>{ contact.contact }</td>
            <td>{ contact.city }</td>
        </tr>
        ))}
        </table>

        <ContactForm />

        </React.Fragment>
    );
  }
  componentDidMount() {
    const url = '/api/contacts.php'

    console.log("Trying to contact the API...");
    
    axios.get(url).then(response => response.data)
    .then((data) => {
      this.setState({ contacts: data })
      console.log(this.state.contacts)
     })
  }
}

ReactDOM.render(<App />, document.getElementById('root'));
</script>
</body>

</html>