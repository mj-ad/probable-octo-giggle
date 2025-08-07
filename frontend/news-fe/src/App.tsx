import { Routes, Route, Link } from 'react-router-dom';
import Login from './pages/Login';
import Register from './pages/Register';
import Feed from './pages/Feed';

function App() {
  return (
    <>
      <nav>
        <Link to="/login" style={{ marginRight: 10 }}>Login</Link>
        <Link to="/register" style={{ marginRight: 10 }}>Register</Link>
        <Link to="/feed">Feed</Link>
      </nav>

      <Routes>
        <Route path="/" element={<Login />} /> {/* default page */}
        <Route path="/login" element={<Login />} />
        <Route path="/register" element={<Register />} />
        <Route path="/feed" element={<Feed />} />
      </Routes>
    </>
  );
}

export default App;
