import { BrowserRouter as Router, Routes, Route, Link } from 'react-router-dom'
import './App.css'

function App() {
  return (
    <Router>
      <nav className="navbar">
        <div className="nav-container">
          <Link to="/" className="nav-logo">🏆 Sportski Događaji</Link>
          <ul className="nav-menu">
            <li><Link to="/">Home</Link></li>
            <li><Link to="/events">Events</Link></li>
            <li><Link to="/tickets">Tickets</Link></li>
          </ul>
        </div>
      </nav>

      <Routes>
        <Route path="/" element={<Home />} />
        <Route path="/events" element={<Events />} />
        <Route path="/tickets" element={<Tickets />} />
      </Routes>
    </Router>
  )
}

function Home() {
  return (
    <div className="container">
      <h1>Dobrodošli</h1>
      <p>Aplikacija za upravljanje ulaznicama za sportske događaje</p>
    </div>
  )
}

function Events() {
  return (
    <div className="container">
      <h1>Sportski Događaji</h1>
      <p>Učitavanje podataka sa servera...</p>
    </div>
  )
}

function Tickets() {
  return (
    <div className="container">
      <h1>Ulaznice</h1>
      <p>Učitavanje dostupnih ulaznica...</p>
    </div>
  )
}

export default App
