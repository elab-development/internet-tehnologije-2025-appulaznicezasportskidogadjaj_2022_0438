import { useState } from 'react'
import Dugme from '../components/Dugme'
import Forma from '../components/Forma'
import '../styles/Auth.css'

export default function Register() {
  const [formData, setFormData] = useState({
    ime: '',
    prezime: '',
    email: '',
    password: '',
    passwordConfirm: ''
  })

  const handleChange = (e) => {
    const { name, value } = e.target
    setFormData(prev => ({
      ...prev,
      [name]: value
    }))
  }

  const handleSubmit = (e) => {
    e.preventDefault()
    
    console.log('Register:', formData)
  }

  return (
    <Forma title="Registracija" onSubmit={handleSubmit}>
      <div className="form-group">
        <label htmlFor="ime">Ime:</label>
        <input
          type="text"
          id="ime"
          name="ime"
          value={formData.ime}
          onChange={handleChange}
          required
        />
      </div>

      <div className="form-group">
        <label htmlFor="prezime">Prezime:</label>
        <input
          type="text"
          id="prezime"
          name="prezime"
          value={formData.prezime}
          onChange={handleChange}
          required
        />
      </div>

      <div className="form-group">
        <label htmlFor="email">Email:</label>
        <input
          type="email"
          id="email"
          name="email"
          value={formData.email}
          onChange={handleChange}
          required
        />
      </div>

      <div className="form-group">
        <label htmlFor="password">Lozinka:</label>
        <input
          type="password"
          id="password"
          name="password"
          value={formData.password}
          onChange={handleChange}
          required
        />
      </div>

      <div className="form-group">
        <label htmlFor="passwordConfirm">Potvrdi Lozinku:</label>
        <input
          type="password"
          id="passwordConfirm"
          name="passwordConfirm"
          value={formData.passwordConfirm}
          onChange={handleChange}
          required
        />
      </div>

      <Dugme type="submit">Registruj se</Dugme>
    </Forma>
  )
}
