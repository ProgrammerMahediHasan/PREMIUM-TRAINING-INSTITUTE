export default function useSEO() {
  const setTitle = (title) => {
    document.title = title
  }
  const setMeta = (name, content) => {
    let tag = document.querySelector(`meta[name='${name}']`)
    if (!tag) {
      tag = document.createElement("meta")
      tag.setAttribute("name", name)
      document.head.appendChild(tag)
    }
    tag.setAttribute("content", content)
  }
  return { setTitle, setMeta }
}
