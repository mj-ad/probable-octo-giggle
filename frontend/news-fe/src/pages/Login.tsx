import { useState } from 'react';
import axios from 'axios';
import { useNavigate } from 'react-router-dom';

export default function Login() {
  const [email, setEmail] = useState('');
  const [password, setPassword] = useState('');
  const navigate = useNavigate();

  const handleLogin = async () => {
  try {
    const response = await axios.post('http://localhost:8000/api/login', {
      email,
      password,
    });
    const token = response.data.token;

    // Save token locally (localStorage/sessionStorage)
    localStorage.setItem('token', token);

    // Redirect to protected page (e.g., feed)
    navigate('/feed');
  } catch (error) {
    alert(error)
  }
};

  return (
    <div>
      <input placeholder="Email" onChange={e => setEmail(e.target.value)} />
      <input placeholder="Password" type="password" onChange={e => setPassword(e.target.value)} />
      <button onClick={handleLogin}>Login</button>
    </div>
  );
}
