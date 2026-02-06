export default function Forma({ children, onSubmit, title }) {
  return (
    <div className="auth-container">
      <div className="auth-card">
        <h1>{title}</h1>
        <form onSubmit={onSubmit} className="auth-form">
          {children}
        </form>
      </div>
    </div>
  )
}
