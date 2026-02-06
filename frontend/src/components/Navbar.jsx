import { Link } from 'react-router-dom'

export default function Navbar() {
  return (
    <nav className="navbar">
      <div className="nav-container">
        <Link to="/" className="nav-logo">Sportski Događaji</Link>
        <ul className="nav-menu">
          <li><Link to="/">Home</Link></li>
          <li><Link to="/dogadjaji">Događaji</Link></li>
          <li><Link to="/karte">Karte</Link></li>
          <li><Link to="/login">Prijava</Link></li>
          <li><Link to="/register">Registracija</Link></li>
        </ul>
      </div>
    </nav>
  )
}
