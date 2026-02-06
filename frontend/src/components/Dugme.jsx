export default function Dugme({ children, onClick, type = 'button', ...props }) {
  return (
    <button type={type} onClick={onClick} {...props}>
      {children}
    </button>
  )
}
